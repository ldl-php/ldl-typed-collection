<?php declare(strict_types=1);

/**
 * This type of validation is a combined validation, basically it's a collection of different validators
 * which are validated in a chain like fashion.
 *
 * This collection also implements the FilterByInterface interface, which makes it possible to filter the validators
 * appended in this collection.
 */

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\KeyValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValueValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Traits\Filter\FilterByInterfaceTrait;
use LDL\Type\Collection\Traits\Locking\LockedCollectionTrait;
use LDL\Type\Collection\Traits\CollectionTrait;
use LDL\Type\Collection\Types\Scalar\Validator\ScalarValidator;
use LDL\Type\Exception\TypeMismatchException;
use LDL\Framework\Base\Exception\LockingException;

abstract class AbstractValidatorChain implements ValidatorChainInterface
{
    use CollectionTrait;
    use FilterByInterfaceTrait;
    use LockedCollectionTrait;

    /**
     * @var bool
     */
    private $strict;

    /**
     * @var string
     */
    private $class;

    public function __construct(
        string $class,
        iterable $items=null
    )
    {
        $this->class = $class;

        if(
            $this->class !== ValueValidatorInterface::class &&
            $this->class !== KeyValidatorInterface::class
        ){
            $msg = sprintf(
                'Validator class must be an instance of "%s" or an instance of "%s"',
                ValueValidatorInterface::class,
                KeyValidatorInterface::class
            );

            throw new \LogicException($msg);
        }

        if(null === $items){
            return;
        }

        foreach($items as $item){
            $this->append($item);
        }
    }

    public function replace($item, $key) : CollectionInterface
    {
        if(!$this->offsetExists($key)){
            return $this->append($item, $key);
        }

        $this->validateKey($key);
        $this->validateItem($item);

        $this->items[$key] = $item;

        return $this;
    }

    public function remove($key): CollectionInterface
    {
        $this->offsetGet($key);
        unset($this->items[$key]);
        return $this;
    }

    public function validate(CollectionInterface $collection, $item, $key) : void
    {
        if(0 === $this->count){
            return;
        }

        /**
         * @var \Exception[]
         */
        $exceptions = [];
        $atLeastOneValid = false;

        /**
         * @var ValueValidatorInterface $validator
         */
        foreach($this as $validator){

            $method = $this->class === KeyValidatorInterface::class ? 'validateKey' : 'validateValue';

            if(!$validator instanceof ValidatorModeInterface){
                $validator->$method($collection, $item, $key);
                $atLeastOneValid=true;
                continue;
            }

            if($validator->isStrict()){
                $validator->$method($collection, $item, $key);
                $atLeastOneValid=true;
                continue;
            }

            try{
                $validator->$method($collection, $item, $key);
                $atLeastOneValid = true;
            }catch(\Exception $e){
                $exceptions[] = $e;
            }
        }

        if($atLeastOneValid){
            return;
        }

        $messages = [];

        foreach($exceptions as $exception){
            $msg = sprintf('"%s": "%s"', get_class($exception), $exception->getMessage());
            $messages[] = $msg;
        }

        throw new Exception\ValidatorChainSoftValidationException(implode("\n", $messages));

    }

    public function append($item, $key=null) : CollectionInterface
    {
        $key = $key ?? $this->count;
        $this->validateKey($key);
        $this->validateItem($item);
        $this->last = $key;

        if(null === $this->first){
            $this->first = $key;
        }

        $this->items[$key] = $item;
        $this->count++;

        return $this;
    }

    private function validateItem($item) : void
    {
        if($this->isLocked()){
            $msg  = 'Validator chain is locked, no additional validators can be added';
            throw new LockingException($msg);
        }

        if(!is_object($item)){
            $msg = sprintf(
                '"%s" expects an object "%s" was given',
                __CLASS__,
                gettype($item)
            );

            throw new TypeMismatchException($msg);
        }

        if($item instanceof $this->class){
            return;
        }

        $msg = sprintf(
            '"%s" expects an object which implements "%s", but "%s" was given',
            get_class($this),
            $this->class,
            get_class($item)
        );

        throw new TypeMismatchException($msg);
    }

    private function validateKey($key) : void
    {
        $validator = new ScalarValidator($strict = true, $acceptToStringObjects = true);
        $validator->validateValue($this, $key,null);
    }

}
