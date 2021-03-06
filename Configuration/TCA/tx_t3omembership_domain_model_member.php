<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$tca = array(
    'ctrl' => array(
        'title'         => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member',
        'label'         => 'name',
        'tstamp'        => 'tstamp',
        'crdate'        => 'crdate',
        'cruser_id'     => 'cruser_id',
        'dividers2tabs' => true,

        'origUid'                  => 't3_origuid',
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete'                   => 'deleted',
        'enablecolumns'            => array(
            'disabled'  => 'hidden',
            'starttime' => 'starttime',
            'endtime'   => 'endtime',
        ),
        'searchFields'             => 'name,external_id,end_date,address,zip,city,country,email,url,membership,',
        'dynamicConfigFile'        => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('t3o_membership') . 'Configuration/TCA/tx_t3omembership_domain_model_member.php',
        'iconfile'                 => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3o_membership') . 'Resources/Public/Icons/tx_t3omembership_domain_model_member.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, firstname, lastname, external_id, end_date, address, zip, city, country, email, invoice_email, url, membership',
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, firstname, lastname, external_id, subscription_no, end_date, address, zip, city, country, email, invoice_email, url, membership,--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,starttime, endtime'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
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
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
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
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
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
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'external_id' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.external_id',
            'config' => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'int,required'
            ),
        ),
        'subscription_no' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.subscription_no',
            'config' => array(
                'type' => 'input',
                'size' => 4,
                'eval' => 'int,required'
            ),
        ),
        'end_date' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.end_date',
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
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.address',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'zip' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.zip',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'city' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.city',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'country' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.country',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'email' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'invoice_email' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.invoice_email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'url' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.url',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'firstname' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.firstname',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'lastname' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.lastname',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'membership' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3o_membership/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_domain_model_member.membership',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_t3omembership_domain_model_membership',
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
    ),
);

if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('typo3_agencies')) {
    $tca['columns']['agency'] = array(
        'config' => array(
            'type' => 'select',
            'foreign_table' => 'tx_typo3agencies_domain_model_agency',
            'foreign_field' => 'related_member',
            'minitems' => 0,
            'maxitems' => 1,
        ),
    );
}

return $tca;