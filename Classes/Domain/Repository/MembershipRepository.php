<?php
namespace T3o\T3oMembership\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;

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
class MembershipRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'uid' => QueryInterface::ORDER_ASCENDING
    );
}