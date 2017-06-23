# Joomla! extension development libraries.  

> 100% unit tested libraries to develop Joomla! extensions. 

[![Build Status](https://travis-ci.org/phproberto/joomla-common.svg?branch=master)](https://travis-ci.org/phproberto/joomla-common)
[![Code Coverage](https://scrutinizer-ci.com/g/phproberto/joomla-common/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/phproberto/joomla-common/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phproberto/joomla-common/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phproberto/joomla-common/?branch=master)

**STILL NOT READY FOR PRODUCTION**

## Quickstart

Sample usage:

```php
use Phproberto\Joomla\Client\Client;

// Get the active client
$client = Client::getActive();

// Check if we are in backend
if ($client->isAdmin())
{
	// Do something
}

// Check if we are in frontend
if ($client->isSite())
{
	// Do something
}

// Retrieve client base folder
echo 'Base application folder is ' . $client->getFolder();

// Retrieve frontend client
$site = Client::site();

// Retrieve backend client
$admin = Client::admin();
```

## Requirements

* **PHP 5.4+** Due to the use of traits
* **Joomla! CMS v3.7+**

## License

This library is licensed under [GNU LESSER GENERAL PUBLIC LICENSE](./LICENSE).  

Copyright (C) 2017 [Roberto Segura López](http://phproberto.com) - All rights reserved.  
