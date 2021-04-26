<?php declare(strict_types=1);

namespace LDL\Type\Collection;

use LDL\Framework\Base\Collection\Contracts\AppendableInterface;
use LDL\Framework\Base\Collection\Contracts\BeforeAppendInterface;
use LDL\Framework\Base\Collection\Contracts\BeforeRemoveInterface;
use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Framework\Base\Collection\Contracts\KeyFilterInterface;
use LDL\Framework\Base\Collection\Contracts\LockAppendInterface;
use LDL\Framework\Base\Collection\Contracts\LockRemoveInterface;
use LDL\Framework\Base\Collection\Contracts\LockReplaceInterface;
use LDL\Framework\Base\Collection\Contracts\RemovableInterface;
use LDL\Framework\Base\Collection\Contracts\ReplaceableInterface;
use LDL\Framework\Base\Collection\Contracts\UnshiftInterface;
use LDL\Framework\Base\Contracts\LockableObjectInterface;

interface TypedCollectionInterface extends CollectionInterface, LockableObjectInterface, AppendableInterface, BeforeAppendInterface, LockAppendInterface, BeforeRemoveInterface, RemovableInterface, LockRemoveInterface, ReplaceableInterface, LockReplaceInterface, UnshiftInterface, KeyFilterInterface
{

}