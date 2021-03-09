<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator\Config;

use LDL\Framework\Base\Contracts\ArrayFactoryInterface;
use LDL\Framework\Base\Contracts\ToArrayInterface;

interface ValidatorConfigInterface extends ArrayFactoryInterface, ToArrayInterface
{

    public function isStrict() : bool;

}