<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator\File;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;

class ReadableFileValidator extends AbstractFileValidator implements AppendItemValidatorInterface
{
    public function validate(CollectionInterface $collection, $item, $key): void
    {
        $item = $this->getFilename($item);

        if(!file_exists($item)){
            $msg = "File \"$item\" does not exists";
            throw new Exception\FileValidatorException($msg);
        }

        if(is_readable($item)){
            return;
        }

        $msg = "File \"$item\" is not readable!\n";
        throw new Exception\FileValidatorException($msg);
    }
}
