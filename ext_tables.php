<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

foreach($GLOBALS['TCA'] as $table=>$configuration) {
	if ($table == 'tx_categories_category') continue;

	t3lib_extMgm::addTCAcolumns(
		$table,
		array(
			'taxonomy_categories' => array (
				'exclude' => 1,
				'label' => 'Taxonomy: Categories',
				'config' => array (
					'type' => 'select',
					'foreign_table' => 'tx_categories_category',
					'foreign_table_where' => ' ORDER BY tx_categories_category.title ASC',
					'MM' => 'tx_categories_record_mm',
					'MM_opposite_field' => 'items',
					'MM_match_fields' => array('tablenames' => $table),
					'size' => 10,
					'autoSizeMax' => 50,
					'maxitems' => 9999,
					'renderMode' => 'tree',
					'treeConfig' => array(
						'parentField' => 'parent',
						'appearance' => array(
							'expandAll' => TRUE,
							'showHeader' => TRUE
						)
					),
					'wizards' => array(
						'_PADDING' => 1,
						'_VERTICAL' => 1,
						'edit' => array(
							'type' => 'popup',
							'title' => 'Edit',
							'script' => 'wizard_edit.php',
							'icon' => 'edit2.gif',
							'popup_onlyOpenIfSelected' => 1,
							'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1'
						),
						'add' => array(
							'type' => 'script',
							'title' => 'Create new',
							'icon' => 'add.gif',
							'params' => array(
								'table' => 'tx_ctegories_category',
								'pid' => '###CURRENT_PID###',
								'setValue' => 'prepend'
							),
							'script' => 'wizard_add.php'
						)
					),
				),
			),
		),
		1
	);
	t3lib_extMgm::addToAllTCAtypes($table, 'taxonomy_categories');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_categories_category');
?>