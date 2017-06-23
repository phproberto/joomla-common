# HasExtension trait  

Trait to be used by classes that have a relationship with a row stored in the `#__extensions` database table.  

* [Requirements](#requirements)
* [Methods](#methods)
    * [getExtension()](#getExtension)
    * [getExtensionProperty()](#getExtensionProperty)

## Requirements <a id="requirements"></a>

Using this trait requires that your class includes a method to load the extension from database. 

Example `loadExtension``method:

```php
	/**
	 * Load extension from DB.
	 *
	 * @return  \stdClass
	 */
	protected function loadExtension()
	{
		$db = \JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('*')
			->from('#__extensions')
			->where('type = ' . $db->quote('module'))
			->where('name = ' . $db->q($this->element));

		$db->setQuery($query);

		return $db->loadObject() ?: new \stdClass;
	}
```

## Methods <a id="methods"></a>

### getExtension() <a id="getExtension"></a>

> Retrieves the associated extension information. 

Extension information is statically cached so it will only cause a DB query if extension information hasn't been loaded previously.  

**Parameters:**

None

**Returns:**

`\stdClass` Object containing extension information

**Examples:**

```php
// ClassWithExtension uses HasExtension trait
$myClass = new ClassWithExtension;

// Start using it. This will load extension (= 1 query)
echo $myClass->getExtension()->extension_id;

// This will use cached extension information because extension information was already loaded 
echo $myClass->getExtension()->name;
```
