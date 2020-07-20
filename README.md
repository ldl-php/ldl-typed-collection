## LDL Type Library

The only reason for this library to exist is because PHP (at the date) has not added support for typed
collections (generics).

I'm always using some kind of typed collection to stay away from arrays and the obvious code that comes with them,
(if it's this, if it's that, if else, if else, etc ...) 

I just built something I can reuse among my projects. And perhaps make it a bit more exciting in the future.

#### Example collection for \SplFileInfo

```php
<?php

use \LDL\Type\Exception\TypeMismatchException;
use \LDL\Type\Collection\Types\Object\ObjectCollection;

class FileCollection extends ObjectCollection
{

    public function validateItem($item) : void
    {       
        parent::validateItem($item);

        if($item instanceof \SplFileInfo){
            return;
        }
        
        $msg = sprintf(
            'Expected value must be an instance of \SplFileInfo, instance of "%s" was given',
            get_class($item)  
        );
        throw new TypeMismatchException($msg);
    }

}
```

### TODO

- Add unit tests