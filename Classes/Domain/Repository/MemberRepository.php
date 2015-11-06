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
 * Class Tx_T3oMembership_Domain_Repository_MemberRepository
 *
 * @author Thomas Löffler <thomas.loeffler@typo3.org>
 */
class Tx_T3oMembership_Domain_Repository_MemberRepository extends Tx_Extbase_Persistence_Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'membership' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
        'name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
    );

    /**
     * @param string $filterString
     * @param integer $filterMembership
     * @return Tx_Extbase_Persistence_QueryResultInterface
     */
    public function findByStringAndMembership($filterString, $filterMembership)
    {
        $query = $this->createQuery();
        $constraints = array();
        if ($filterString) {
            $filterString = $this->getDatabaseConnection()
                ->escapeStrForLike($filterString, 'tx_t3omembership_domain_model_member');
            $constraints[] = $query->like('name', '%' . $filterString . '%');
        }
        if ($filterMembership) {
            $constraints[] = $query->equals('membership', $filterMembership);
        }

        return $query->matching($query->logicalAnd($constraints))->execute();
    }

    /**
     * @return t3lib_DB
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}