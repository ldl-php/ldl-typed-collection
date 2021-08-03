<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Framework\Base\Contracts\PriorityInterface;
use LDL\Framework\Base\Collection\Contracts\PrioritySortingInterface;
use LDL\Type\Collection\Types\Object\ObjectCollection;
use LDL\Framework\Base\Collection\Traits\PrioritySortingInterfaceTrait;
use LDL\Validators\InterfaceComplianceValidator;

class PriorityCollectionExample extends ObjectCollection implements PrioritySortingInterface
{
    use PrioritySortingInterfaceTrait;
    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new InterfaceComplianceValidator(PriorityInterface::class))
            ->lock();
    }
}

class PriorityClass1 implements PriorityInterface
{
    public function getPriority(): int
    {
        return 1;
    }
}

class PriorityClass2 implements PriorityInterface
{
    public function getPriority(): int
    {
        return 2;
    }
}

echo "Create new PriorityCollectionExample class instance\n";
$collection = new PriorityCollectionExample();

echo "Append PriorityClass2\n";
$collection->append(new PriorityClass2());

echo "Append PriorityClass1\n";
$collection->append(new PriorityClass1());

try {

    echo "Append \stdClass (Must throw exception!)\n";
    $collection->append(new \stdClass());

}catch(\Exception $e){

    echo "EXCEPTION: {$e->getMessage()}\n";

}

echo "Sort by priority ascending:\n";

/**
 * @var PriorityInterface $item
 */
foreach($collection->sortByPriority(PrioritySortingInterface::SORT_ASCENDING) as $item){
    echo $item->getPriority()."\n";
}

echo "\nSort by priority descending:\n";

/**
 * @var PriorityInterface $item
 */
foreach($collection->sortByPriority(PrioritySortingInterface::SORT_DESCENDING) as $item){
    echo $item->getPriority()."\n";
}