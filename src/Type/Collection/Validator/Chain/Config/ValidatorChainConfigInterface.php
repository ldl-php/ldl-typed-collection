<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator\Chain\Config;

use LDL\Framework\Base\Contracts\LockableObjectInterface;
use LDL\Type\Collection\Interfaces\CollectionInterface;

interface ValidatorChainConfigInterface extends CollectionInterface, LockableObjectInterface, \JsonSerializable
{

}