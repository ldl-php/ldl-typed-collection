<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\String;

use LDL\Type\Collection\AbstractTypedCollection;
use LDL\Type\Collection\Helper\TypeCollectionHelper;
use LDL\Type\Collection\Interfaces\Type\ToPrimitiveArrayInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;

abstract class AbstractStringCollection extends AbstractTypedCollection implements ToPrimitiveArrayInterface
{
    use Traits\ToStringPrimitiveArray;

    /**
     * @var string
     */
    private $imploded;

    /**
     * @var string
     */
    private $implodeSeparator=',';

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getBeforeAppend()->append(function(){
            $this->imploded = null;
        });

        $this->getBeforeRemove()->append(function(){
            $this->imploded = null;
        });

        $this->getBeforeReplace()->append(function(){
            $this->imploded = null;
        });
    }

    public function filterEmptyLines() : self
    {
        $return = new static();

        foreach($this as $string){
            $string = trim((string)$string,"\r\n ");
            if('' === $string){
                continue;
            }
            $return->append($string);
        }

        return $return;
    }

    public function implode(string $separator=',', bool $considerToStringObjects=true) : string
    {
        if(null !== $this->imploded && $separator === $this->implodeSeparator){
            return $this->imploded;
        }

        $this->implodeSeparator = $separator;
        $this->imploded = implode($separator, TypeCollectionHelper::toArray($this));
        return $this->imploded;
    }

    public function __toString()
    {
        return $this->implode();
    }
}