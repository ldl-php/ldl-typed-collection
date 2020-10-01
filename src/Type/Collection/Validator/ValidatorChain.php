<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorInterface;
use LDL\Type\Collection\Interfaces\Validation\ValidatorModeInterface;
use LDL\Type\Collection\Traits\Locking\LockedCollectionTrait;
use LDL\Type\Collection\Traits\CollectionTrait;
use LDL\Type\Exception\TypeMismatchException;
use LDL\Framework\Base\Exception\LockingException;

final class ValidatorChain implements ValidatorChainInterface
{
    use CollectionTrait;
    use LockedCollectionTrait;

    /**
     * @var bool
     */
    private $strict;

    /**
     * ValidatorChain constructor.
     *
     * @param iterable|null $items
     * @throws LockingException
     * @throws TypeMismatchException
     */
    public function __construct(iterable $items=null)
    {
        if(null === $items){
            return;
        }

        foreach($items as $item){
            $this->append($item);
        }
    }

    public function validate(CollectionInterface $collection, $item, $key) : void
    {
        /**
         * @var \Exception[]
         */
        $exceptions = [];
        $atLeastOneValid = false;

        /**
         * @var ValidatorInterface $validator
         */
        foreach($this as $validator){

            if(!$validator instanceof ValidatorModeInterface){
                $validator->validate($collection, $item, $key);
                $atLeastOneValid=true;
                continue;
            }

            if($validator->isStrict()){
                $validator->validate($collection, $item, $key);
                $atLeastOneValid=true;
                continue;
            }

            try{
                $validator->validate($collection, $item, $key);
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
        if($this->isLocked()){
            $msg  = 'Validator chain is locked, no additional items can be added';
            throw new LockingException($msg);
        }

        $key = $key ?? $this->count;

        $this->validateKey($key);

        if(!is_object($item)){
            $msg = sprintf(
                '"%s" expects an object "%s" was give',
                __CLASS__,
                gettype($item)
            );

            throw new TypeMismatchException($msg);
        }

        if(!$item instanceof ValidatorInterface){
            $msg = sprintf(
                '"%s" expects that item of class "%s" applies interface "%s"',
                __CLASS__,
                get_class($item),
                ValidatorInterface::class
            );

            throw new TypeMismatchException($msg);
        }

        $key = $key ?? $this->count();
        $this->last = $key;

        if(null === $this->first){
            $this->first = $key;
        }

        $this->items[$key] = $item;
        $this->count++;

        return $this;
    }

}
