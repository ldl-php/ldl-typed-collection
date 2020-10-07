<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\Interfaces\Selection\SingleSelectionInterface;
use LDL\Type\Collection\Traits\Selection\SingleSelectionTrait;
use LDL\Type\Collection\AbstractCollection;
use LDL\Framework\Base\Exception\LockingException;

class SingleSelectionCollectionExample extends AbstractCollection implements SingleSelectionInterface
{
    use SingleSelectionTrait;
}

echo "Create collection instance\n";
$collection  = new SingleSelectionCollectionExample();

echo "Append item 123 using my_key_1 as key\n";
$collection->append('123','my_key_1');

echo "Append item 456 using my_key_2 as key\n";
$collection->append('456','my_key_2');

echo "Select item my_key_1 in collection\n";
$collection->select('my_key_1');

echo "Is selection locked?\n";
var_dump($collection->isSelectionLocked());

echo "Get selected item key\n";
var_dump($collection->getSelectedKey());

echo "Selected item value\n";
var_dump($collection->getSelectedItem());

echo "Lock selection\n";
$collection->lockSelection();

echo "Try to add a select another item, exception must be thrown\n";

try {
    $collection->select('my_key_2');
}catch(LockingException $e){
    echo "EXCEPTION: {$e->getMessage()}\n";
}