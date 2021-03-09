<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Lockable\Validator;

use LDL\Framework\Base\Contracts\LockableObjectInterface;
use LDL\Framework\Base\Exception\LockingException;
use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\RemoveItemValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Traits\Validator\ValidatorInterfaceTrait;
use LDL\Type\Collection\Types\Lockable\Validator\Config\LockingValidatorConfig;
use LDL\Type\Collection\Validator\Config\ValidatorConfigInterface;
use LDL\Type\Collection\Validator\Exception\InvalidConfigException;
use LDL\Type\Exception\TypeMismatchException;

class LockingValidator implements AppendItemValidatorInterface, RemoveItemValidatorInterface, KeyValidatorInterface, ValueValidatorInterface
{
    use ValidatorInterfaceTrait;

    /**
     * @var LockingValidatorConfig
     */
    private $config;

    public function __construct()
    {
        $this->config = new LockingValidatorConfig();
    }

    public function validateKey(CollectionInterface $collection, $item, $key) : void
    {
        $this->validateValue($collection, $item, $key);
    }

    public function validateValue(CollectionInterface $collection, $item, $key): void
    {
        if(!$collection instanceof LockableObjectInterface){
            $msg = sprintf(
                'To use "%s", your collection must implement "%s"',
            __CLASS__,
                LockableObjectInterface::class
            );

            throw new TypeMismatchException($msg);
        }

        if($collection->isLocked()){
            $msg = 'Collection is locked, can not add or remove elements';
            throw new LockingException($msg);
        }
    }

    /**
     * @param ValidatorConfigInterface $config
     * @return ValidatorInterface
     * @throws InvalidConfigException
     */
    public static function fromConfig(ValidatorConfigInterface $config): ValidatorInterface
    {
        if(false === $config instanceof LockingValidatorConfig){
            $msg = sprintf(
                'Config expected to be %s, config of class %s was given',
                __CLASS__,
                get_class($config)
            );
            throw new InvalidConfigException($msg);
        }

        /**
         * @var LockingValidatorConfig $config
         */
        return new self();
    }

    /**
     * @return LockingValidatorConfig
     */
    public function getConfig(): LockingValidatorConfig
    {
        return $this->config;
    }
}
