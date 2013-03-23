<?php

namespace Meteko\Categories\Service;

class DataHandlerService {

	/**
	 * @param $status
	 * @param $table
	 * @param $id
	 * @param $fieldArray
	 * @param $dataHandler \TYPO3\CMS\Core\DataHandling\DataHandler
	 */
	public function processDatamap_postProcessFieldArray($status, $table, $id, &$fieldArray, $dataHandler) {
		if(array_key_exists('taxonomy_categories', $fieldArray)) {
			unset($fieldArray['taxonomy_categories']);
		}

	}

	public function processCmdmap_preProcess($command, $table, $id, $value, $dataHandler) {
	}

}

?>