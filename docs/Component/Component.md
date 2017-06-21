# Component class

> `Phproberto\Joomla\Component\Component`

Component class is intended to ease the management of component related stuff.  

* Namespace
* Methods
    * clearInstance($option)
        * Parameters
        * Returns
        * Examples
    * getInstance($option = null)
        * Parameters
        *

## Methods

### clearInstance($option)

> Clears a cached instance from the static cache. 

By default components are statically cached to avoid that their information is retrieved multiple times from database in the same time execution. This is the perfect for 99% of the usages but there are special cases where you may want to ensure that you clear the cached instance. 

**Parameters:**

* *$option (required):* Component option. Example: com_content.

**Returns:**

`void`

**Examples:**

```php
// This will store a param in the statically cached instance
Component::getInstance('com_content')
    ->setParam('foo', 'var');

// This will return `var` because instance is cached
$foo = Component::getInstance('com_content')
    ->getParam('foo');

// This will clear the cached instance
Component::clearInstance('com_content');

// This won't return `var` because cached instance was cleared
$foo = Component::getInstance('com_content')
    ->getParam('foo');
```

### getFreshInstance($option)

> Retrieve a non-statically-cached instance.

By default components are statically cached to avoid that their information is retrieved multiple times from database in the same time execution. This is the perfect for 99% of the usages but there are special cases where you may want to ensure that you retrieve a non-cachhed instance. 

**Parameters:**

* *$option (required)*: Component option. Example: com_content.

**Returns:**

`Phproberto\Joomla\Component\Component`;

**Examples:**

```php
// This will store a param in the statically cached instance
Component::getInstance('com_content')
    ->setParam('foo', 'var');

// This will return `var` because instance is cached
$foo = Component::getInstance('com_content')
    ->getParam('foo');

// This won't return `var` because cached instance was cleared
$foo = Component::getFreshInstance('com_content')
    ->getParam('foo');
```
