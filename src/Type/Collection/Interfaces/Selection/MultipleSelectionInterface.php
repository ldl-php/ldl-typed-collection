<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Selection;

use LDL\Type\Collection\Exception\EmptyCollectionException;
use LDL\Type\Collection\Exception\ItemSelectionException;
use LDL\Type\Collection\Interfaces\CollectionInterface;

interface MultipleSelectionInterface extends PrivateSelectableInterface {

    /**
     * Return the selected items, previously selected by the select method
     *
     * @throws EmptyCollectionException if the collection is empty
     * @throws ItemSelectionException if there is no item selected
     * @return mixed
     */
    public function getSelectedItems() : CollectionInterface;

    /**
     * Returns an array containing keys previously selected
     *
     * @return array
     */
    public function getSelectedKeys() : array;
}