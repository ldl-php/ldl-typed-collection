<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator\Chain\Loader;

use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Validator\Chain\Config\Item\ValidatorChainConfigItem;
use LDL\Type\Collection\Validator\KeyValidatorChain;
use LDL\Type\Collection\Validator\ValueValidatorChain;

class ValidatorChainLoader
{
    public static function loadValueChain(array $data) : ValueValidatorChain
    {
        $return = new ValueValidatorChain();

        foreach($data as $item){
            $config = ValidatorChainConfigItem::fromArray($item);
            $return->append($config->getValidatorInstance());
        }

        return $return;
    }

    public static function loadKeyChain(array $data)
    {
        $return = new KeyValidatorChain();

        foreach($data as $item){
            $config = ValidatorChainConfigItem::fromArray($item);
            $return->append($config->getValidatorInstance());
        }

        return $return;
    }
}