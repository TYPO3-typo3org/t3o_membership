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
 * Class Tx_T3oMembership_Controller_MemberController
 *
 * @author Thomas Löffler <thomas.loeffler@typo3.org>
 */
class Tx_T3oMembership_Controller_MemberController extends Tx_Extbase_MVC_Controller_ActionController
{

    /**
     * memberRepository
     *
     * @var Tx_T3oMembership_Domain_Repository_MemberRepository
     */
    protected $memberRepository;

    /**
     * membershipRepository
     *
     * @var Tx_T3oMembership_Domain_Repository_MembershipRepository
     */
    protected $membershipRepository;

    /**
     * injectMemberRepository
     *
     * @param Tx_T3oMembership_Domain_Repository_MemberRepository $memberRepository
     * @return void
     */
    public function injectMemberRepository(Tx_T3oMembership_Domain_Repository_MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * injectMembershipRepository
     *
     * @param Tx_T3oMembership_Domain_Repository_MembershipRepository $membershipRepository
     * @return void
     */
    public function injectMembershipRepository(
        Tx_T3oMembership_Domain_Repository_MembershipRepository $membershipRepository
    ) {
        $this->membershipRepository = $membershipRepository;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $filterMembership = 0;
        $filterString = '';

        if ($this->request->hasArgument('filter') && $this->request->getArgument('filter')) {
            $filterString = htmlspecialchars($this->request->getArgument('filter'));
            $this->view->assign('filter', $filterString);
        }
        if ($this->request->hasArgument('membership') && $this->request->getArgument('membership')) {
            $filterMembership = (int)$this->request->getArgument('membership');
            $this->view->assign('membership', $filterMembership);
        }

        if ($filterString || $filterMembership) {
            $members = $this->memberRepository->findByStringAndMembership($filterString, $filterMembership);
        } else {
            $members = $this->memberRepository->findAll();
        }
        $memberships = $this->membershipRepository->findAll();

        $this->view->assign('memberships', $memberships);
        $this->view->assign('members', $members);
    }

}