<?php declare(strict_types=1);

namespace LDL\Type\Collection\Interfaces\Factory;

use LDL\Framework\Base\Contracts\FactoryInterface;
use LDL\Type\Collection\Types\Email\EmailCollection;
use LDL\Type\Collection\Exception\EmailCollectionFactoryException;

interface EmailCollectionFactoryInterface extends FactoryInterface
{    
    /**
     * @param  EmailCollection $collection
     * @throws EmailCollectionFactoryException
     * @return mixed
     */
    public static function fromEmailCollection(EmailCollection $collection);
}