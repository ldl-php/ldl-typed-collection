<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\KeyValidatorChainTrait;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Type\Collection\Validator\ValueValidatorChain;
use LDL\Type\Collection\Validator\KeyValidatorChain;
use LDL\Type\Collection\Validator\Chain\Dumper\ValidatorChainDumper;
use LDL\Type\Collection\Validator\Chain\Loader\ValidatorChainLoader;
use LDL\Type\Collection\Types\String\Validator\StringValidator;

class FromConfigCollectionExample extends AbstractCollection implements HasKeyValidatorChainInterface, HasValueValidatorChainInterface
{
    use KeyValidatorChainTrait;
    use ValueValidatorChainTrait;

    public function __construct(
        iterable $items = null,
        ValueValidatorChain $values=null,
        KeyValidatorChain $keys = null
    )
    {
        parent::__construct($items);

        $this->getKeyValidatorChain()
            ->append(new UniqueValidator(),null);

        if(null !== $keys) {
            $this->getKeyValidatorChain()->appendMany($keys);
        }

        $this->getValueValidatorChain()
            ->append(new UniqueValidator(), null, false);

        if(null !== $values) {
            $this->getValueValidatorChain()->appendMany($values);
        }
    }
}

echo "Create collection instance\n";

$collection = new FromConfigCollectionExample();
$collection->getValueValidatorChain()->append(new StringValidator(true));

//dump($collection->getValueValidatorChain());
$file = tempnam(sys_get_temp_dir(),'ldl_config_collection_example');

ValidatorChainDumper::dumpValueChain($collection, $file);

$collection = new FromConfigCollectionExample();
echo "--------------------------------------\n";

$collection->getValueValidatorChain()
->appendMany(
    ValidatorChainLoader::loadValueChain(json_decode(file_get_contents($file), true)),
);


foreach($collection->getValueValidatorChain() as $validator){
    echo get_class($validator)."\n";
}

unlink($file);