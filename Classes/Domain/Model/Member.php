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
 * Class Tx_T3oMembership_Domain_Model_Member
 *
 * @author Thomas Löffler <thomas.loeffler@typo3.org>
 */
class Tx_T3oMembership_Domain_Model_Member extends Tx_Extbase_DomainObject_AbstractEntity
{
    /**
     * @var Tx_Typo3Agencies_Domain_Model_Agency
     */
    protected $agency;

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
     * firstname
     *
     * @var string
     */
    protected $firstname;

    /**
     * url
     *
     * @var string
     */
    protected $url;

    /**
     * lastname
     *
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $invoiceEmail;

    /**
     * membership
     *
     * @var Tx_T3oMembership_Domain_Model_Membership
     */
    protected $membership;

    /**
     * @return Tx_Typo3Agencies_Domain_Model_Agency
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Returns the externalId
     *
     * @return integer $externalId
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * Sets the externalId
     *
     * @param integer $externalId
     * @return void
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
    }

    /**
     * Returns the endDate
     *
     * @return DateTime $endDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Sets the endDate
     *
     * @param DateTime $endDate
     * @return void
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Returns the address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the address
     *
     * @param string $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Returns the zip
     *
     * @return string $zip
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Sets the zip
     *
     * @param string $zip
     * @return void
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city
     *
     * @param string $city
     * @return void
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Returns the country
     *
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the country
     *
     * @param string $country
     * @return void
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url
     *
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getInvoiceEmail()
    {
        return $this->invoiceEmail;
    }

    /**
     * @param string $invoiceEmail
     */
    public function setInvoiceEmail($invoiceEmail)
    {
        $this->invoiceEmail = $invoiceEmail;
    }

    /**
     * Returns the membership
     *
     * @return Tx_T3oMembership_Domain_Model_Membership $membership
     */
    public function getMembership()
    {
        return $this->membership;
    }

    /**
     * Sets the membership
     *
     * @param Tx_T3oMembership_Domain_Model_Membership $membership
     * @return void
     */
    public function setMembership(Tx_T3oMembership_Domain_Model_Membership $membership)
    {
        $this->membership = $membership;
    }

}
