<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_t3omembership_domain_model_membership'] = array(
    'ctrl' => $TCA['tx_t3omembership_domain_model_membership']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, logo, personal_membership, no_filter',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, logo, personal_membership, no_filter, --div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' => 'tx_t3omembership_domain_model_membership',
                'foreign_table_where' => 'AND tx_t3omembership_domain_model_membership.pid=###CURRENT_PID### AND tx_t3omembership_domain_model_membership.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'name' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_membership.name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'logo' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_membership.logo',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'uploads/tx_t3omembership',
                'allowed' => '*',
                'disallowed' => 'php',
                'size' => 5,
            ),
        ),
        'personal_membership' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_membership.personal_membership',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'no_filter' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_membership.no_filter_option',
            'config' => array(
                'type' => 'check',
            ),
        ),
    ),
);
