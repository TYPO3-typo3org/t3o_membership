<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
    $_EXTKEY,
    'List',
    'Association member list'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'TYPO3 Membership');

t3lib_extMgm::addLLrefForTCAdescr('tx_t3omembership_domain_model_member',
    'EXT:t3o_membership/Resources/Private/Language/locallang_csh_tx_t3omembership_domain_model_member.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_t3omembership_domain_model_member');
$TCA['tx_t3omembership_domain_model_member'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,

        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'name,external_id,end_date,address,zip,city,country,email,url,membership,',
        'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Member.php',
        'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_t3omembership_domain_model_member.gif'
    ),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_t3omembership_domain_model_membership',
    'EXT:t3o_membership/Resources/Private/Language/locallang_csh_tx_t3omembership_domain_model_membership.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_t3omembership_domain_model_membership');
$TCA['tx_t3omembership_domain_model_membership'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_membership',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,

        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'name,logo,',
        'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Membership.php',
        'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_t3omembership_domain_model_membership.gif'
    ),
);
