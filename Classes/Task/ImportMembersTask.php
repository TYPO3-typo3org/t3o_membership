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
	 * @return boolean
	 */
	public function execute() {
		// does the import file exist?
		if (!file_exists(PATH_site . $this->getImportFile())) {
			return FALSE;
		} else {
			$this->getDatabaseConnection()->exec_TRUNCATEquery('tx_t3omembership_domain_model_member');
			$fileData = file(PATH_site . $this->getImportFile());
			foreach ($fileData as $key => $line) {
				if ($key) {
					$fields = t3lib_div::trimExplode("\t", $line);
					$member = array(
						'name' =>  $fields[6],
						'external_id' => (int) $fields[0],
						'address' => $fields[7] ? $fields[7] : $fields[8],
						'zip' => $fields[10],
						'city' => $fields[11],
						'end_date' => strtotime($fields[16]),
						'membership' => $this->getMembershipUid($fields[12]),
						'pid' => $this->getMembershipStoragePid(),
						'crdate' => time(),
						'tstamp' => time()
					);

					$this->getDatabaseConnection()->exec_INSERTquery(
						'tx_t3omembership_domain_model_member',
						$member
					);
				}
			}
		}

		return TRUE;
	}

	/**
	 * @param string $membershipName
	 * @return integer
	 */
	protected function getMembershipUid($membershipName) {
		$membershipName = $this->getDatabaseConnection()
			->fullQuoteStr(trim(str_replace('Membership', '', $membershipName)), 'tx_t3omembership_domain_model_membership');

		$membershipRecord = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
			'uid',
			'tx_t3omembership_domain_model_membership',
			'name = ' . $membershipName . ' AND NOT deleted AND NOT hidden'
		);
		if (!empty($membershipRecord)) {
			$membershipUid = $membershipRecord['uid'];
		} else {
			$newMembership = array(
				'name' => mysql_real_escape_string($membershipName),
				'pid' => $this->getMembershipStoragePid(),
				'crdate' => time(),
				'tstamp' => time()
			);
			$this->getDatabaseConnection()->exec_INSERTquery(
				'tx_t3omembership_domain_model_membership',
				$newMembership
			);
			$membershipUid = $this->getDatabaseConnection()->sql_insert_id();
		}

		return $membershipUid;
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