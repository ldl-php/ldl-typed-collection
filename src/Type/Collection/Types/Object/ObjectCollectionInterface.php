<?php declare(strict_types=1);

namespace LDL\Type\Collection\Types\Object;

use LDL\Framework\Base\Collection\Contracts\FilterByClassInterface;
use LDL\Framework\Base\Collection\Contracts\FilterByInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\TypedCollectionInterface;

interface ObjectCollectionInterface extends TypedCollectionInterface, FilterByInterface, FilterByClassInterface, HasAppendValueValidatorChainInterface
{

}