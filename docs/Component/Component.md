# `Component` class

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
// Initial non-cached instance
$component = Component::getInstance('com_content');

// This will cause a DB query to retrieve params
$params = $component->getParams();

// This will set a param for in our loaded instance
$component->setParam('foo', 'var');

// This will return a statically-cached instance
$component2 = Component::getInstance('com_content');

// This won't cause an additional DB query
$params2 = $component2->getParams();

// This will return `var` because instance is cached
$foo = $component2->getParam('foo');

// This clears this cached instance from static cache
Component::clearInstance('com_content');

// This will return a non-cached instance
$component3 = Component::getInstance('com_content');

// This will reload params from DB
$params3 = $component3->getParams();

// This won't return `var` because cached instance was removed
$foo = $component3->getParam('foo');
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
// Initial non-cached instance
$component = Component::getInstance('com_content');

// This will cause a DB query to retrieve params
$params = $component->getParams();

// This will set a param for in our loaded instance
$component->setParam('foo', 'var');

// This will return a statically-cached instance
$component2 = Component::getInstance('com_content');

// This won't cause an additional DB query
$params2 = $component2->getParams();

// This will return `var` because instance is cached
$foo = $component2->getParam('foo');

// This will return a non-cached instance
$component3 = Component::getFreshInstance('com_content');

// This will reload params from DB
$params3 = $component3->getParams();

// This won't return `var` because cached instance was removed
$foo = $component3->getParam('foo');
```
