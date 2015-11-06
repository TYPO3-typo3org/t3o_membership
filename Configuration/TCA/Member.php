<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_t3omembership_domain_model_member'] = array(
    'ctrl' => $TCA['tx_t3omembership_domain_model_member']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, firstname, lastname, external_id, end_date, address, zip, city, country, email, invoice_email, url, membership',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, firstname, lastname, external_id, end_date, address, zip, city, country, email, invoice_email, url, membership,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
                'foreign_table' => 'tx_t3omembership_domain_model_member',
                'foreign_table_where' => 'AND tx_t3omembership_domain_model_member.pid=###CURRENT_PID### AND tx_t3omembership_domain_model_member.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            )
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
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'external_id' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.external_id',
            'config' => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'int,required'
            ),
        ),
        'end_date' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.end_date',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'datetime,required',
                'checkbox' => 1,
                'default' => time()
            ),
        ),
        'address' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.address',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'zip' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.zip',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'city' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.city',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'country' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.country',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'email' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'invoice_email' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.invoice_email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'url' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.url',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'firstname' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.firstname',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'lastname' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.lastname',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'membership' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xml:tx_t3omembership_domain_model_member.membership',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_t3omembership_domain_model_membership',
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
    ),
);
