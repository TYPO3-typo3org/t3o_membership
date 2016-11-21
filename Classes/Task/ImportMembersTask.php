<?php

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
class Tx_T3oMembership_Task_ImportMembersTask extends tx_scheduler_Task
{
    /**
     * @var array
     */
    protected $hookObjects = array();

    /**
     * @var string
     */
    protected $importFile = '';

    /**
     * @var integer
     */
    protected $membershipStoragePid = 0;

    /**
     * @var array
     */
    protected $memberships = array();

    /**
     * @return boolean
     */
    public function execute()
    {
        t3lib_div::devLog('[tx_scheduler_ImportMember]: execute', 't3o_membership', 0);
        $membershipRecords = $this->getDatabaseConnection()->exec_SELECTgetRows(
            'uid, name',
            'tx_t3omembership_domain_model_membership',
            'NOT hidden AND NOT deleted'
        );

        foreach ($membershipRecords as $membershipRecord) {
            $this->memberships[$membershipRecord['name']] = (int)$membershipRecord['uid'];
        }

        // does the import file exist?
        $importFile = $this->getImportFile();
        if (!t3lib_div::isAbsPath($importFile)) {
            $importFile = t3lib_div::getFileAbsFileName($importFile);
        }

        if (!file_exists($importFile)) {
            t3lib_div::devLog(
                '[tx_scheduler_ImportMember]: no importfile - given value: ' . $importFile,
                't3o_membership',
                0
            );
            return false;
        }

        $this->initializeHookObjects();

        $fileData = file($importFile);
        array_shift($fileData);
        foreach ($fileData as $key => $line) {
            $line = iconv('ISO-8859-15', 'UTF-8', $line);
            /** @noinspection PhpParamsInspection */
            $fields = t3lib_div::trimExplode("\t", $line);
            $membershipUid = $this->getMembershipUid($fields[12]);
            // Skip records with unknown membership types.
            if (empty($membershipUid)) {
                continue;
            }
            $subscriptionNo = (int)$fields[14];

            $endDate = $this->getMemberEndDate($fields[15]);

            // If the user has cancelled his membership "Gekündigt", we set the endtime enable field.
            $endTime = !empty($fields[17]) ? $endDate : 0;

            $hidden = false;

            if ($endTime > 0 && $endTime < time()) {
                $hidden = true;
            }

            $member = array(
                'name' => $fields[6],
                'subscription_no' => $subscriptionNo,
                'external_id' => (int)$fields[0],
                'address' => $fields[7] !== '' ? $fields[7] : $fields[8],
                'zip' => $fields[10],
                'city' => $fields[11],
                'country' => $fields[13],
                'end_date' => $endDate,
                'endtime' => $endTime,
                'hidden' => $hidden,
                'starttime' => 0,
                'membership' => $membershipUid,
                'pid' => $this->getMembershipStoragePid(),
                'crdate' => time(),
                'tstamp' => time(),
                'invoice_email' => $fields[84],
                'email' => $fields[79],
                'url' => $fields[80],
                'firstname' => $fields[82],
                'lastname' => $fields[83]
            );

            $memberUid = $this->createOrUpdateMember($subscriptionNo, $member);

            foreach($this->hookObjects as $hookObject) {
                if (method_exists($hookObject, 'postUpdateMemberData')) {
                    $hookObject->postUpdateMemberData($memberUid, $member);
                }
            }
        }

        return true;
    }

    /**
     * Checks if the member with the given subscription number already exists in the database.
     * If he exists, his data will be updated, otherwise a new record will be inserted.
     *
     * @param int $subscriptionNo
     * @param array $memberData
     * @return int The uid of the updated / inserted member.
     */
    protected function createOrUpdateMember($subscriptionNo, array $memberData)
    {
        $existingMember = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
            'uid',
            'tx_t3omembership_domain_model_member',
            'subscription_no=' . $subscriptionNo
        );

        if (!empty($existingMember['uid'])) {
            $memberUid = $existingMember['uid'];
            $resource = $this->getDatabaseConnection()->exec_UPDATEquery(
                'tx_t3omembership_domain_model_member',
                'uid=' . (int)$memberUid,
                $memberData
            );
        } else {
            $resource = $this->getDatabaseConnection()->exec_INSERTquery(
                'tx_t3omembership_domain_model_member',
                $memberData
            );
            $memberUid = $this->getDatabaseConnection()->sql_insert_id();
        }

        $this->getDatabaseConnection()->sql_free_result($resource);

        return (int)$memberUid;
    }

    /**
     * Parses the value of the "Beginn" column to a UNIX timestamp.
     *
     * @param string $endDate
     * @return array
     */
    protected function getMemberEndDate($endDate)
    {
        if (empty($endDate)) {
            return 0;
        }

        $endDateTime = DateTime::createFromFormat('d.m.Y', $endDate);
        $endDateTime->setTime(0, 0, 0);


       # $endDateTime->add(new DateInterval('P1Y'));

        return $endDateTime->getTimestamp();
    }

    /**
     * @param string $membershipName
     * @return integer|null
     */
    protected function getMembershipUid($membershipName)
    {
        $membershipName = trim(str_replace('Membership', '', $membershipName));
        if (empty($this->memberships[$membershipName])) {
            return null;
        }
        return $this->memberships[$membershipName];
    }

    /**
     * Gets importFile
     *
     * @return string
     */
    public function getImportFile()
    {
        return $this->importFile;
    }

    /**
     * Sets importFile
     *
     * @param string $importFile
     */
    public function setImportFile($importFile)
    {
        $this->importFile = $importFile;
    }

    /**
     * Gets membershipStoragePid
     *
     * @return int
     */
    public function getMembershipStoragePid()
    {
        return $this->membershipStoragePid;
    }

    /**
     * Instantiates all configured hook objects.
     */
    protected function initializeHookObjects()
    {
        if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['t3o_membership']['importMemberTaksHooks'])) {
            return;
        }
        foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['t3o_membership']['importMemberTaksHooks'] as $classData) {
            $hookObject = t3lib_div::getUserObj($classData);
            if (!is_object($hookObject)) {
                throw new UnexpectedValueException(
                    'The hook object class '. $classData . ' could not be instantiated.'
                );
            }
            $this->hookObjects[] = $hookObject;
        }
    }

    /**
     * Sets membershipStoragePid
     *
     * @param int $membershipStoragePid
     */
    public function setMembershipStoragePid($membershipStoragePid)
    {
        $this->membershipStoragePid = $membershipStoragePid;
    }

    /**
     * @return t3lib_DB
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
