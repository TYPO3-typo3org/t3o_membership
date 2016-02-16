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
 * Class Tx_T3oMembership_Domain_Model_Membership
 * @author Thomas Löffler <thomas.loeffler@typo3.org>
 */
class Tx_T3oMembership_Domain_Model_Membership extends Tx_Extbase_DomainObject_AbstractValueObject
{

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
     * personalMembership
     *
     * @var bool
     * @validate NotEmpty
     */
    protected $personalMembership;


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
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
     * Returns the logo
     *
     * @return string $logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Sets the logo
     *
     * @param string $logo
     * @return void
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * Returns the status of a membership (personal or company)
     *
     * @return bool
     */
    public function getPersonalMembership()
    {
        return $this->personalMembership;
    }

    /**
     * Sets the logo
     *
     * @param bool $personalMembership
     * @return void
     */
    public function setPersonalMembership($personalMembership)
    {
        $this->personalMembership = $personalMembership;
    }


    /**
     * Returns true, if the membership is a personal membership
     *
     * @return bool
     */
    public function isPersonalMembership()
    {
        return $this->personalMembership;
    }


}
