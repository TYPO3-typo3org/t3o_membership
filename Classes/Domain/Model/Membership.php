<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Thomas Löffler <thomas.loeffler@typo3.org>
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package t3o_membership
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_T3oMembership_Domain_Model_Membership extends Tx_Extbase_DomainObject_AbstractValueObject {

	/**
	 * name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * logo
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $logo;

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the logo
	 *
	 * @return string $logo
	 */
	public function getLogo() {
		return $this->logo;
	}

	/**
	 * Sets the logo
	 *
	 * @param string $logo
	 * @return void
	 */
	public function setLogo($logo) {
		$this->logo = $logo;
	}

}
?>