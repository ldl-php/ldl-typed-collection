<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Selection;

use LDL\Type\Collection\Exception\EmptyCollectionException;
use LDL\Type\Collection\Exception\ItemSelectionException;

interface MultipleSelectionInterface extends SelectionLockingInterface
{
    /**
     * Select one or more items inside the collection
     * @throws ItemSelectionException if selection is locked
     * @param mixed $key
     * @return MultipleSelectionInterface
     */
    public function select($key) : MultipleSelectionInterface;

    /**
     * Return the selected items, previously selected by the select method
     *
     * @throws EmptyCollectionException if the collection is empty
     * @throws ItemSelectionException if there is no item selected
     * @return mixed
     */
    public function getSelectedItems() : MultipleSelectionInterface;

    /**
     * Returns an array containing keys previously selected
     *
     * @throws ItemSelectionException if no items were selected
     * @return array
     */
    public function getSelectedKeys() : array;

    /**
     * Obtains the count of selected items
     *
     * @return int
     */
    public function getSelectedCount() : int;

    /**
     * Truncates the instance to selected values only (does not creates a new instance)
     *
     * @throws ItemSelectionException if there is no item selected
     * @return MultipleSelectionInterface
     */
    public function truncateToSelected() : MultipleSelectionInterface;
}