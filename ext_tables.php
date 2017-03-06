<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'List',
    'Association member list'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript',
    'TYPO3 Membership'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_t3omembership_domain_model_member',
    'EXT:t3o_membership/Resources/Private/Language/locallang_csh_tx_t3omembership_domain_model_member.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_t3omembership_domain_model_member'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_t3omembership_domain_model_membership',
    'EXT:t3o_membership/Resources/Private/Language/locallang_csh_tx_t3omembership_domain_model_membership.xlf'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_t3omembership_domain_model_membership'
);
