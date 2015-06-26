<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'List',
	array(
		'Member' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Member' => '',
		
	)
);

?>