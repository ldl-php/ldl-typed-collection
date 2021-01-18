<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Selection;

use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Exception\EmptyCollectionException;

interface SingleSelectionInterface extends SelectionLockingInterface
{

    /**
     * Select an item in the collection
     *
     * @throws LockingException if selection is locked
     * @param string $key
     * @return SingleSelectionInterface
     */
    public function select($key) : SingleSelectionInterface;

    /**
     * Return the selected item, previously selected by the select method
     *
     * @throws EmptyCollectionException if the collection is empty
     */
    public function getSelectedItem();

    /**
     * Returns the selected key
     * @return number|string
     */
    public function getSelectedKey();

    /**
     * Informs if an item was selected
     *
     * @return bool
     */
    public function hasSelection() : bool;
}