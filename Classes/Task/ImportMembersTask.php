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

        $fileData = file($importFile);
        array_shift($fileData);
        foreach ($fileData as $key => $line) {
            $line = iconv('ISO-8859-15', 'UTF-8', $line);
            $fields = t3lib_div::trimExplode("\t", $line);
            $membershipUid = $this->getMembershipUid($fields[12]);
            // Skip records with unknown membership types.
            if (empty($membershipUid)) {
                continue;
            }
            $subscriptionNo = (int)$fields[14];
            $endTime = strtotime($fields[15]);
            $member = [
                'name' => $fields[6],
                'subscription_no' => $subscriptionNo,
                'external_id' => (int)$fields[0],
                'address' => $fields[7] !== '' ? $fields[7] : $fields[8],
                'zip' => $fields[10],
                'city' => $fields[11],
                'country' => $fields[13],
                'end_date' => $endTime,
                'endtime' => $endTime,
                'starttime' => strtotime(date('d.m.Y', $endTime) . ' -1 year'),
                'membership' => $membershipUid,
                'pid' => $this->getMembershipStoragePid(),
                'crdate' => time(),
                'tstamp' => time(),
                'invoice_email' => $fields[84],
                'email' => $fields[79],
                'url' => $fields[80],
                'firstname' => $fields[82],
                'lastname' => $fields[83]
            ];

            $this->createOrUpdateMemeber($subscriptionNo, $member);
        }

        return true;
    }

    /**
     * Checks if the member with the given subscription number already exists in the database.
     * If he exists, his data will be updated, otherwise a new record will be inserted.
     *
     * @param int $subscriptionNo
     * @param array $memberData
     */
    protected function createOrUpdateMemeber($subscriptionNo, array $memberData)
    {
        $existingMember = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
            'uid',
            'tx_t3omembership_domain_model_member',
            'subscription_no=' . $subscriptionNo
        );

        if (!empty($existingMember['uid'])) {
            $resource = $this->getDatabaseConnection()->exec_UPDATEquery(
                'tx_t3omembership_domain_model_member',
                'uid=' . (int)$existingMember['uid'],
                $memberData
            );
        } else {
            $resource = $this->getDatabaseConnection()->exec_INSERTquery(
                'tx_t3omembership_domain_model_member',
                $memberData
            );
        }

        $this->getDatabaseConnection()->sql_free_result($resource);
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
