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
 * Class Tx_T3oMembership_Domain_Repository_MembershipRepository
 *
 * @author Thomas Löffler <thomas.loeffler@typo3.org>
 */
class Tx_T3oMembership_Domain_Repository_MembershipRepository extends Tx_Extbase_Persistence_Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'uid' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
    );

}