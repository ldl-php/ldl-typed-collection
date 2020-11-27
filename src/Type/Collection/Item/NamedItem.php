<?php declare(strict_types=1);

namespace LDL\Type\Collection\Item;

class NamedItem implements NamedItemInterface
{
    /**
     * @var mixed
     */
    private $name;

    /**
     * @var mixed
     */
    private $value;

    public function __construct($name, $value)
    {
        if(false === is_scalar($name)){
            $msg = sprintf(
                '"%s": "name" parameter expects an scalar value, "%s" was given',
                __CLASS__,
                gettype($name)
            );

            throw new \InvalidArgumentException($msg);
        }

        $this->name = $name;
        $this->value = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }
}