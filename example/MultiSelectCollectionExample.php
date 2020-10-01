<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\Interfaces\Selection\MultipleSelectionInterface;
use LDL\Type\Collection\Traits\Selection\MultipleSelectionTrait;
use LDL\Type\Collection\AbstractCollection;
use LDL\Framework\Base\Exception\LockingException;

class MultiSelectTest extends AbstractCollection implements MultipleSelectionInterface
{
    use MultipleSelectionTrait;
}

echo "Create collection instance\n";
$collection = new MultiSelectTest();

echo "Append item 123 using my_key_1 as key\n";
$collection->append('123','my_key_1');

echo "Append item 456 using my_key_2 as key\n";
$collection->append('456','my_key_2');

echo "Append item 789 using my_key_3 as key\n";
$collection->append('789','my_key_3');

echo "Select item my_key_1 in collection\n";
$collection->select('my_key_1', false);

echo "Select item my_key_3 in collection\n";
$collection->select('my_key_3');

echo "Is selection locked?\n";
var_dump($collection->isSelectionLocked());

echo "Get selected item key\n";
var_dump($collection->getSelectedKeys());

echo "Lock selection\n";
$collection->lockSelection();

try {

    echo "Try to select item my_key_3, exception must be thrown\n";
    $collection->select('my_key_2');

}catch(LockingException $e) {

    echo "EXCEPTION: {$e->getMessage()}\n";

}

echo "Selected item value\n";

foreach($collection->getSelectedItems() as $key => $value){
    echo "Selected: $key\n";
}
