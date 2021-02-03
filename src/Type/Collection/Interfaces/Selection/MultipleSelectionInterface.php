<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Selection;

use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Exception\EmptyCollectionException;

interface MultipleSelectionInterface extends SelectionLockingInterface
{
    /**
     * Select one or more items inside the collection
     * @throws LockingException if selection is locked
     * @param iterable $key
     * @return MultipleSelectionInterface
     */
    public function select($key) : MultipleSelectionInterface;

    /**
     * Selects all items
     *
     * @return MultipleSelectionInterface
     */
    public function selectAll() : MultipleSelectionInterface;

    /**
     * Return the selected items, previously selected by the select method
     *
     * @return MultipleSelectionInterface
     */
    public function getSelectedItems() : MultipleSelectionInterface;

    /**
     * Returns an array containing keys previously selected
     *
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
     * @throws LockingException If the selection is locked
     * @return MultipleSelectionInterface
     */
    public function truncateToSelected() : MultipleSelectionInterface;

    /**
     * Reset / unset items selection
     *
     * @throws LockingException
     * @return MultipleSelectionInterface
     */
    public function removeSelection() : MultipleSelectionInterface;

    /**
     * Informs if items where selected
     * @return bool
     */
    public function hasSelection() : bool;
}
