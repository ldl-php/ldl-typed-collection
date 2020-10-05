<?php declare(strict_types=1);

require '../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Interfaces\Validation\HasValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Filter\FilterByActiveStateInterface;
use LDL\Type\Collection\Traits\Filter\FilterByActiveStateTrait;
use LDL\Type\Collection\Types\Object\Validator\InterfaceComplianceItemValidator;
use LDL\Framework\Base\Contracts\IsActiveInterface;

class ActiveStateFilterExample extends AbstractCollection implements HasValidatorChainInterface, FilterByActiveStateInterface
{
    use ValueValidatorChainTrait;
    use FilterByActiveStateTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getValidatorChain()
            ->append(new InterfaceComplianceItemValidator(IsActiveInterface::class));
    }

}

class Test1 implements IsActiveInterface
{
    public function isActive(): bool
    {
        return true;
    }
}

class Test2 implements IsActiveInterface
{
    public function isActive(): bool
    {
        return false;
    }
}

echo "Create collection instance\n";

$collection = new ActiveStateFilterExample();
$collection->append(new Test1());
$collection->append(new Test2());

foreach($collection->filterByActiveState() as $item){
    echo get_class($item)."\n";
}