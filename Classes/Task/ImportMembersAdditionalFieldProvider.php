<?php
namespace T3o\T3oMembership\Task;

use TYPO3\CMS\Extbase\Scheduler\Task;
use TYPO3\CMS\Scheduler\Controller\SchedulerModuleController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

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

/**
 * Class Tx_T3oMembership_Task_ImportMembersAdditionalFields
 *
 * @author Thomas Löffler <thomas.loeffler@typo3.org>
 */
class ImportMembersAdditionalFieldProvider implements \TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface
{

    /**
     * Gets additional fields to render in the form to add/edit a task
     *
     * @param array $taskInfo
     * @param Task $task
     * @param SchedulerModuleController $schedulerModule
     * @return array A two dimensional array, array('Identifier' => array('fieldId' => array('code' => '',
     *              'label' => '', 'cshKey' => '', 'cshLabel' => ''))
     */
    public function getAdditionalFields(array &$taskInfo, Task $task, SchedulerModuleController $schedulerModule)
    {
        $additionalFields = array();
        // adds field for setting file path for CSV file to import
        $importFile = '';
        $membershipStoragePid = 0;
        if ($task instanceof Task) {
            $importFile = htmlspecialchars($task->getImportFile());
            $membershipStoragePid = (int)$task->getMembershipStoragePid();
        }
        $additionalFields['importFile'] = array(
            'code' => '<input type="text" name="tx_scheduler[importFile]" value="' . $importFile . '" />',
            'label' => LocalizationUtility::translate('importFile', 't3omembership')
        );

        // adds field for setting storage PID
        $additionalFields['storagePid'] = array(
            'code' => '<input type="text" name="tx_scheduler[storagePid]" value="' . $membershipStoragePid . '" />',
            'label' => LocalizationUtility::translate('storagePid', 't3omembership')
        );

        return $additionalFields;
    }

    /**
     * Validates the additional fields' values
     *
     * @param array $submittedData
     * @param SchedulerModuleController $schedulerModule
     * @return boolean
     */
    public function validateAdditionalFields(array &$submittedData, SchedulerModuleController $schedulerModule)
    {
        // only validation for importFile would be a file_exists, but it will be validated in the task itself

        return true;
    }

    /**
     * Takes care of saving the additional fields' values in the task's object
     *
     * @param array $submittedData
     * @param Task $task
     * @return void
     */
    public function saveAdditionalFields(array $submittedData, Task $task)
    {
        $task->setImportFile($submittedData['importFile']);
        $task->setMembershipStoragePid($submittedData['storagePid']);
    }

}