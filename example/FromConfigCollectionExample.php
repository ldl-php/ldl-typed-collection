<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces\Validation\HasAppendKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\Traits\Validator\AppendKeyValidatorChainTrait;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;
use LDL\Type\Collection\Validator\UniqueValidator;
use LDL\Validators\Chain\Dumper\ValidatorChainDumper;
use LDL\Validators\Chain\Loader\ValidatorChainLoader;
use LDL\Validators\Chain\ValidatorChain;
use LDL\Validators\StringValidator;

class FromConfigCollectionExample extends AbstractCollection implements HasAppendKeyValidatorChainInterface, HasAppendValueValidatorChainInterface
{
    use AppendKeyValidatorChainTrait;
    use AppendValueValidatorChainTrait;

    public function __construct(
        iterable $items = null,
        ValidatorChain $values=null,
        ValidatorChain $keys = null
    )
    {
        parent::__construct($items);

        $this->getAppendKeyValidatorChain()
            ->append(new UniqueValidator(),null);

        if(null !== $keys) {
            $this->getAppendKeyValidatorChain()
                ->appendMany($keys);
        }

        $this->getAppendValueValidatorChain()
            ->append(new UniqueValidator(), null, false);

        if(null !== $values) {
            $this->getAppendValueValidatorChain()
                ->appendMany($values);
        }
    }
}

echo "Create collection instance\n";

$collection = new FromConfigCollectionExample();
$collection->getAppendValueValidatorChain()->append(new StringValidator(true));

$file = tempnam(sys_get_temp_dir(),'ldl_config_collection_example');

ValidatorChainDumper::dump($collection->getAppendValueValidatorChain(), $file);

$collection = new FromConfigCollectionExample();
echo "--------------------------------------\n";

$collection->getAppendValueValidatorChain()
->appendMany(
    ValidatorChainLoader::load(json_decode(file_get_contents($file), true)),
);

foreach($collection->getAppendValueValidatorChain() as $validator){
    echo get_class($validator)."\n";
}

unlink($file);