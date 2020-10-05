## LDL Type Library

The only reason for this library to exist is because PHP (at the date) has not added support for typed
collections (generics).

I'm always using some kind of typed collection to stay away from arrays and the obvious code that comes with them,
(if it's this, if it's that, if else, if else, etc ...) 

I just built something I can reuse among my projects. And perhaps make it a bit more exciting in the future.

#### Example collection for \SplFileInfo

```php
<?php declare(strict_types=1);

use LDL\Type\Collection\Types\Object\ObjectCollection;
use LDL\Type\Collection\Types\Object\Validator\InterfaceComplianceValidator;

class FileCollection extends ObjectCollection
{
    public function __construct(iterable $items = null) {
        parent::__construct($items);

        $this->getValidatorChain()
        ->append(new InterfaceComplianceValidator(\SplFileInfo::class))
        ->lock();
    }

}
```

### TODO

- Add unit tests