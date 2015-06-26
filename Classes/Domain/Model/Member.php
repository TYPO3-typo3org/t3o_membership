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
class Tx_T3oMembership_Domain_Model_Member extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Member name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * externalId
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $externalId;

	/**
	 * endDate
	 *
	 * @var DateTime
	 * @validate NotEmpty
	 */
	protected $endDate;

	/**
	 * address
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $address;

	/**
	 * zip
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $zip;

	/**
	 * city
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $city;

	/**
	 * country
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $country;

	/**
	 * email
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $email;

	/**
	 * url
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * membership
	 *
	 * @var Tx_T3oMembership_Domain_Model_Membership
	 */
	protected $membership;

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
	 * Returns the externalId
	 *
	 * @return integer $externalId
	 */
	public function getExternalId() {
		return $this->externalId;
	}

	/**
	 * Sets the externalId
	 *
	 * @param integer $externalId
	 * @return void
	 */
	public function setExternalId($externalId) {
		$this->externalId = $externalId;
	}

	/**
	 * Returns the endDate
	 *
	 * @return DateTime $endDate
	 */
	public function getEndDate() {
		return $this->endDate;
	}

	/**
	 * Sets the endDate
	 *
	 * @param DateTime $endDate
	 * @return void
	 */
	public function setEndDate($endDate) {
		$this->endDate = $endDate;
	}

	/**
	 * Returns the address
	 *
	 * @return string $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param string $address
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Returns the zip
	 *
	 * @return string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the country
	 *
	 * @return string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the url
	 *
	 * @return string $url
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Sets the url
	 *
	 * @param string $url
	 * @return void
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * Returns the membership
	 *
	 * @return Tx_T3oMembership_Domain_Model_Membership $membership
	 */
	public function getMembership() {
		return $this->membership;
	}

	/**
	 * Sets the membership
	 *
	 * @param Tx_T3oMembership_Domain_Model_Membership $membership
	 * @return void
	 */
	public function setMembership(Tx_T3oMembership_Domain_Model_Membership $membership) {
		$this->membership = $membership;
	}

}
?>