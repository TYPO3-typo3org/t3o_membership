<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'T3o.'.$_EXTKEY,
    'List',
    array(
        'Member' => 'list',

    ),
    // non-cacheable actions
    array(
        'Member' => 'list',

    )
);

// Import members
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Tx_T3oMembership_Task_ImportMembersTask'] = array(
    'extension' => $_EXTKEY,
    'title' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_task_importmemberstask.name',
    'description' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf:tx_t3omembership_task_importmemberstask.description',
    'additionalFields' => 'tx_t3omembership_task_importmembers_additionalfieldprovider',
);
