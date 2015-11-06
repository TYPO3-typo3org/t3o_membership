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
 * Testcase.
 *
 * @author Thomas Löffler <thomas.loeffler@typo3.org>
 */
class Tx_T3oMembership_Domain_Model_MemberTest extends Tx_Extbase_Tests_Unit_BaseTestCase
{
    /**
     * @var Tx_T3oMembership_Domain_Model_Member
     */
    protected $fixture;

    public function setUp()
    {
        $this->fixture = new Tx_T3oMembership_Domain_Model_Member();
    }

    public function tearDown()
    {
        unset($this->fixture);
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->fixture->setName('Conceived at T3CON10');

        $this->assertSame(
            'Conceived at T3CON10',
            $this->fixture->getName()
        );
    }

    /**
     * @test
     */
    public function getExternalIdReturnsInitialValueForInteger()
    {
        $this->assertSame(
            0,
            $this->fixture->getExternalId()
        );
    }

    /**
     * @test
     */
    public function setExternalIdForIntegerSetsExternalId()
    {
        $this->fixture->setExternalId(12);

        $this->assertSame(
            12,
            $this->fixture->getExternalId()
        );
    }

    /**
     * @test
     */
    public function getEndDateReturnsInitialValueForDateTime()
    {
    }

    /**
     * @test
     */
    public function setEndDateForDateTimeSetsEndDate()
    {
    }

    /**
     * @test
     */
    public function getAddressReturnsInitialValueForString()
    {
    }

    /**
     * @test
     */
    public function setAddressForStringSetsAddress()
    {
        $this->fixture->setAddress('Conceived at T3CON10');

        $this->assertSame(
            'Conceived at T3CON10',
            $this->fixture->getAddress()
        );
    }

    /**
     * @test
     */
    public function getZipReturnsInitialValueForString()
    {
    }

    /**
     * @test
     */
    public function setZipForStringSetsZip()
    {
        $this->fixture->setZip('Conceived at T3CON10');

        $this->assertSame(
            'Conceived at T3CON10',
            $this->fixture->getZip()
        );
    }

    /**
     * @test
     */
    public function getCityReturnsInitialValueForString()
    {
    }

    /**
     * @test
     */
    public function setCityForStringSetsCity()
    {
        $this->fixture->setCity('Conceived at T3CON10');

        $this->assertSame(
            'Conceived at T3CON10',
            $this->fixture->getCity()
        );
    }

    /**
     * @test
     */
    public function getCountryReturnsInitialValueForString()
    {
    }

    /**
     * @test
     */
    public function setCountryForStringSetsCountry()
    {
        $this->fixture->setCountry('Conceived at T3CON10');

        $this->assertSame(
            'Conceived at T3CON10',
            $this->fixture->getCountry()
        );
    }

    /**
     * @test
     */
    public function getEmailReturnsInitialValueForString()
    {
    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail()
    {
        $this->fixture->setEmail('Conceived at T3CON10');

        $this->assertSame(
            'Conceived at T3CON10',
            $this->fixture->getEmail()
        );
    }

    /**
     * @test
     */
    public function getUrlReturnsInitialValueForString()
    {
    }

    /**
     * @test
     */
    public function setUrlForStringSetsUrl()
    {
        $this->fixture->setUrl('Conceived at T3CON10');

        $this->assertSame(
            'Conceived at T3CON10',
            $this->fixture->getUrl()
        );
    }

    /**
     * @test
     */
    public function getMembershipReturnsInitialValueForTx_T3oMembership_Domain_Model_Membership()
    {
    }

    /**
     * @test
     */
    public function setMembershipForTx_T3oMembership_Domain_Model_MembershipSetsMembership()
    {
    }

}