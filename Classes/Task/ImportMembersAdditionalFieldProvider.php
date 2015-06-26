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

/**
 * Class Tx_T3oMembership_Task_ImportMembersAdditionalFields
 * @author Thomas Löffler <thomas.loeffler@typo3.org>
 */
class Tx_T3oMembership_Task_ImportMembers_AdditionalFieldProvider implements tx_scheduler_AdditionalFieldProvider {

	/**
	 * Gets additional fields to render in the form to add/edit a task
	 * @param array $taskInfo
	 * @param tx_scheduler_Task $task
	 * @param tx_scheduler_Module $schedulerModule
	 * @return array A two dimensional array, array('Identifier' => array('fieldId' => array('code' => '',
	 *              'label' => '', 'cshKey' => '', 'cshLabel' => ''))
	 */
	public function getAdditionalFields(array &$taskInfo, $task, tx_scheduler_Module $schedulerModule) {
		$additionalFields = array();
		// adds field for setting file path for CSV file to import
		$additionalFields['importFile'] = array(
			'code' => '<input type="text" name="tx_scheduler[importFile]" value="' . $task->getImportFile() . '" />',
			'label' => Tx_Extbase_Utility_Localization::translate('importFile', 't3o_membership')
		);

		// adds field for setting storage PID
		$additionalFields['storagePid'] = array(
			'code' => '<input type="text" name="tx_scheduler[storagePid]" value="' . $task->getMembershipStoragePid() . '" />',
			'label' => Tx_Extbase_Utility_Localization::translate('storagePid', 't3o_membership')
		);

		return $additionalFields;
	}

	/**
	 * Validates the additional fields' values
	 * @param array $submittedData
	 * @param tx_scheduler_Module $schedulerModule
	 * @return boolean
	 */
	public function validateAdditionalFields(array &$submittedData, tx_scheduler_Module $schedulerModule) {
		// only validation for importFile would be a file_exists, but it will be validated in the task itself

		return TRUE;
	}

	/**
	 * Takes care of saving the additional fields' values in the task's object
	 * @param array $submittedData
	 * @param tx_scheduler_Task $task
	 * @return void
	 */
	public function saveAdditionalFields(array $submittedData, tx_scheduler_Task $task) {
		$task->setImportFile($submittedData['importFile']);
		$task->setMembershipStoragePid($submittedData['storagePid']);
	}

}