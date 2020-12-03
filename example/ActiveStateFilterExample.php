<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Filter\FilterByActiveStateInterface;
use LDL\Type\Collection\Traits\Filter\FilterByActiveStateTrait;
use LDL\Type\Collection\Types\Object\Validator\InterfaceComplianceItemValidator;
use LDL\Framework\Base\Contracts\IsActiveInterface;

class ActiveStateFilterExample extends AbstractCollection implements HasValueValidatorChainInterface, FilterByActiveStateInterface
{
    use ValueValidatorChainTrait;
    use FilterByActiveStateTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getValueValidatorChain()
            ->append(new InterfaceComplianceItemValidator(IsActiveInterface::class));
    }

}

class ActiveStateFilterExampleTest1 implements IsActiveInterface
{
    public function isActive(): bool
    {
        return true;
    }
}

class ActiveStateFilterExampleTest2 implements IsActiveInterface
{
    public function isActive(): bool
    {
        return false;
    }
}

echo "Create collection instance\n";

$collection = new ActiveStateFilterExample();
$collection->append(new ActiveStateFilterExampleTest1());
$collection->append(new ActiveStateFilterExampleTest2());

foreach($collection->filterByActiveState() as $item){
    echo get_class($item)."\n";
}