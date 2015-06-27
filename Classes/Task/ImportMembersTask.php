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

class Tx_T3oMembership_Task_ImportMembersTask extends tx_scheduler_Task {

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
	public function execute() {
		$membershipRecords = $this->getDatabaseConnection()->exec_SELECTgetRows(
			'uid, name',
			'tx_t3omembership_domain_model_member',
			'NOT hidden AND NOT deleted'
		);

		foreach ($membershipRecords as $membershipRecord) {
			$this->memberships[$membershipRecord['name']] = $membershipRecord['uid'];
		}

		// does the import file exist?
		$importFile = t3lib_div::getFileAbsFileName($this->getImportFile());
		if (!file_exists($importFile)) {
			return FALSE;
		} else {
			$this->getDatabaseConnection()->exec_TRUNCATEquery('tx_t3omembership_domain_model_member');
			$fileData = file($importFile);
			array_shift($fileData);
			foreach ($fileData as $key => $line) {
				$fields = t3lib_div::trimExplode("\t", $line);
				$member = array(
					'name' =>  $fields[6],
					'external_id' => (int) $fields[0],
					'address' => $fields[7] !== '' ? $fields[7] : $fields[8],
					'zip' => $fields[10],
					'city' => $fields[11],
					'end_date' => strtotime($fields[16]),
					'membership' => $this->getMembershipUid($fields[12]),
					'pid' => $this->getMembershipStoragePid(),
					'crdate' => time(),
					'tstamp' => time()
				);

				$resource = $this->getDatabaseConnection()->exec_INSERTquery(
					'tx_t3omembership_domain_model_member',
					$member
				);

				$this->getDatabaseConnection()->sql_free_result($resource);
			}
		}

		return TRUE;
	}

	/**
	 * @param string $membershipName
	 * @return integer
	 */
	protected function getMembershipUid($membershipName) {
		$membershipName = trim(str_replace('Membership', '', $membershipName));

		return $this->memberships[$membershipName];
	}

	/**
	 * Gets importFile
	 * @return string
	 */
	public function getImportFile() {
		return $this->importFile;
	}

	/**
	 * Sets importFile
	 * @param string $importFile
	 */
	public function setImportFile($importFile) {
		$this->importFile = $importFile;
	}

	/**
	 * Gets membershipStoragePid
	 * @return int
	 */
	public function getMembershipStoragePid() {
		return $this->membershipStoragePid;
	}

	/**
	 * Sets membershipStoragePid
	 * @param int $membershipStoragePid
	 */
	public function setMembershipStoragePid($membershipStoragePid) {
		$this->membershipStoragePid = $membershipStoragePid;
	}

	/**
	 * @return t3lib_DB
	 */
	protected function getDatabaseConnection() {
		return $GLOBALS['TYPO3_DB'];
	}
}