<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Framework\Base\Contracts\IsActiveInterface;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Validators\InterfaceComplianceValidator;
use LDL\Framework\Base\Collection\Traits\FilterByActiveStateInterfaceTrait;
use LDL\Framework\Base\Collection\Contracts\FilterByActiveStateInterface;

class ActiveStateFilterExample extends AbstractCollection implements HasAppendValueValidatorChainInterface, FilterByActiveStateInterface
{
    use AppendValueValidatorChainTrait;
    use FilterByActiveStateInterfaceTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);
        $this->getAppendValueValidatorChain()
            ->getChainItems()
            ->append(new InterfaceComplianceValidator(IsActiveInterface::class));
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