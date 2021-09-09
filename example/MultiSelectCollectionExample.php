<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\Interfaces\Selection\MultipleSelectionInterface;
use LDL\Type\Collection\Traits\Selection\MultipleSelectionInterfaceTrait;
use LDL\Type\Collection\AbstractCollection;
use LDL\Framework\Base\Exception\LockingException;

class MultiSelectCollectionExample extends AbstractCollection implements MultipleSelectionInterface
{
    use MultipleSelectionInterfaceTrait;
}

$data = [
  'my_key_1' => 123,
  'my_key_2' => 456,
  'my_key_3' => 789
];

echo "Create collection instance\n";
$collection = new MultiSelectCollectionExample();

echo "Append the following data to the created collection:\n\n";

echo var_export($data,true)."\n\n";

$collection->appendMany($data, true);

echo "Check if collection has a selection (must return false)\n\n";
var_dump($collection->hasSelection());

echo "\nSelect item my_key_1 in collection\n";
$collection->select('my_key_1');

echo "\nCheck if collection has a selection (must return true)\n\n";
var_dump($collection->hasSelection());

echo "\nSelect item my_key_3 in collection\n";
$collection->select('my_key_3');

echo "\nObtain count of selected items (must be 2)\n";
echo "\nCount of selected items is: {$collection->getSelectionCount()}\n\n";

echo "Lock selection\n\n";
$collection->lockSelection();

echo "Remove item with key: my_key_3\n\n";
$collection->removeByKeyLast();

echo "Print selected keys, the removed key (my_key_3) must not SHOW up in the selected values\n\n";

foreach($collection->getSelection() as $key=>$value){
    var_dump("$key => $value");
}


echo "\nPrint collection keys and values:\n\n";
foreach($collection as $key=>$value){
    var_dump($key, $value);
}

echo "\nCheck if selection is locked (true must be returned):\n\n";
var_dump($collection->isSelectionLocked());

try {

    echo "\nTry to select item my_key_2, exception must be thrown (due to the selection being locked)\n\n";
    $collection->select('my_key_2');

}catch(LockingException $e) {

    echo "EXCEPTION: {$e->getMessage()}\n\n";

}

echo "Print selected keys:\n\n";

foreach($collection->getSelection() as $key => $value){
    echo "SELECTED | key: $key , value: $value\n";
}

echo "\nTruncate to selected\n\n";

$collection->truncateToSelected();

echo "Print items in collection, only my_key_1 must show up\n\n";

foreach($collection as $key => $value){
    echo "Item in collection | key: $key , value: $value\n";
}
