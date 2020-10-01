<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Selection;

use LDL\Type\Collection\Exception\EmptyCollectionException;
use LDL\Type\Collection\Exception\ItemSelectionException;

interface SingleSelectionInterface extends PrivateSelectableInterface {

    /**
     * Return the selected item, previously selected by the select method
     *
     * @throws EmptyCollectionException if the collection is empty
     * @throws ItemSelectionException if there is no item selected
     */
    public function getSelectedItem();

    /**
     * Returns the selected key
     * @return number|string
     */
    public function getSelectedKey();

}