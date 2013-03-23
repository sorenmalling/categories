<?php

namespace Meteko\Categories\Collection;

class CategoryCollection extends \TYPO3\CMS\Core\Collection\AbstractRecordCollection implements \TYPO3\CMS\Core\Collection\EditableCollectionInterface {

	/**
	 * Returns an array of the persistable properties and contents
	 * which are processable by TCEmain.
	 *
	 * For internal usage in persist only.
	 *
	 * @return array
	 */
	protected function getPersistableDataArray() {
		return array();
	}

	/**
	 * Adds on entry to the collection
	 *
	 * @param mixed $data
	 * @return void
	 */
	public function add($data) {
		$this->storage->push($data);
	}

	/**
	 * Adds a set of entries to the collection
	 *
	 * @param \TYPO3\CMS\Core\Collection\CollectionInterface $other
	 * @return void
	 */
	public function addAll(\TYPO3\CMS\Core\Collection\CollectionInterface $other) {
		foreach ($other as $value) {
			$this->add($value);
		}
	}

	/**
	 * Removes the given entry from collection
	 * Note: not the given "index"
	 *
	 * @param mixed $data
	 * @return void
	 */
	public function remove($data) {
		$offset = 0;
		foreach ($this->storage as $value) {
			if ($value == $data) {
				break;
			}
			$offset++;
		}
		$this->storage->offsetUnset($offset);
	}

	// Should be moved to AbstractCollection vv
	/**
	 * Removes all entries from the collection
	 *
	 * collection will be empty afterwards
	 *
	 * @return void
	 */
	public function removeAll()
	{
		$this->storage = new \SplDoublyLinkedList();
	}

	/**
	 * Populates the content-entries of the storage
	 * Queries the underlying storage for entries of the collection
	 * and adds them to the collection data.
	 * If the content entries of the storage had not been loaded on creation
	 * ($fillItems = false) this function is to be used for loading the contents
	 * afterwards.
	 *
	 * @return void
	 */
	public function loadContents() {
		$entries = $this->getCollectedRecords();
		$this->removeAll();
		foreach ($entries as $entry) {
			$this->add($entry);
		}
	}

}
?>