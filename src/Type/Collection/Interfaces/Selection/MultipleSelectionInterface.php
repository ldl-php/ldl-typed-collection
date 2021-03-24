<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Selection;

use LDL\Framework\Base\Collection\Exception\UndefinedOffsetException;
use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Types\String\StringCollection;

interface MultipleSelectionInterface extends SelectionLockingInterface
{
    public const SELECT_DIRTY = 'dirty';
    public const SELECT_CLEAN = 'clean';

    /**
     * Select one or more items inside the collection
     *
     * @param iterable $key
     * @param bool $keyCheck
     *
     * @return MultipleSelectionInterface
     *
     * @throws LockingException if selection is locked
     * @throws UndefinedOffsetException in case $keyCheck was set to true, and the key given key(s) do not exist
     * in the collection.
     */
    public function select($key, bool $keyCheck = true) : MultipleSelectionInterface;

    /**
     * Selects all items
     *
     * @return MultipleSelectionInterface
     */
    public function selectAll() : MultipleSelectionInterface;

    /**
     * Return an instance of the collection which is filtered by the selected items
     *
     * @return MultipleSelectionInterface
     */
    public function filterBySelectedItems() : MultipleSelectionInterface;

    /**
     * Returns a StringCollection containing keys previously selected
     *
     * @return StringCollection|null
     */
    public function getSelection() : StringCollection;

    /**
     * @return int
     */
    public function getSelectionCount() : int;

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
