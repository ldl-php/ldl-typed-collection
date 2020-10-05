<?php declare(strict_types=1);

namespace LDL\Type\Collection\Validator\File;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\AppendItemValidatorInterface;

class FileFullAccessValidator extends AbstractFileValidator implements AppendItemValidatorInterface
{
    public function validate(CollectionInterface $collection, $item, $key): void
    {
        $item = $this->getFilename($item);

        if(!file_exists($item)){
            $msg = "File \"$item\" does not exists";
            throw new Exception\FileValidatorException($msg);
        }

        $readable = is_readable($item);
        $writable = is_writable($item);

        if($readable && $writable){
            return;
        }

        if(!$readable){
            $msg = "File \"$item\" is not readable";
            throw new Exception\FileValidatorException($msg);
        }

        if(!$writable){
            $msg = "File \"$item\" is not writable";
            throw new Exception\FileValidatorException($msg);
        }
    }
}
