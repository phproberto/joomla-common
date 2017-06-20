<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Component;

use Joomla\Registry\Registry;
use Phproberto\Joomla\Traits;

defined('JPATH_PLATFORM') || die;

/**
 * Table finder.
 *
 * @since  __DEPLOY_VERSION__
 */
class Component
{
	use Traits\HasExtension, Traits\HasParams;

	/**
	 * Component option. Example: com_content
	 *
	 * @var  string
	 */
	protected $option;

	/**
	 * Component prefix for classes, etc.
	 *
	 * @var  string
	 */
	protected $prefix;

	/**
	 * Cached instances.
	 *
	 * @var  array
	 */
	protected static $instances = array();

	/**
	 * Constructor
	 *
	 * @param   string  $option  Component option
	 */
	public function __construct($option)
	{
		$option = trim(strtolower($option));

		if (empty($option))
		{
			throw new \InvalidArgumentException(__CLASS__ . ': Empty component option.');
		}

		$this->option = $option;
	}

	/**
	 * Clear a singleton instance.
	 *
	 * @param   string  $option  Component option
	 *
	 * @return  void
	 */
	public static function clearInstance($option)
	{
		unset(static::$instances[get_called_class()][$option]);
	}

	/**
	 * Get the active component. Mainly for testing purposes.
	 *
	 * @return  string
	 */
	protected static function getActiveComponent()
	{
		return \JApplicationHelper::getComponentName();
	}

	/**
	 * Get a singleton instance.
	 *
	 * @param   string  $option  Component option
	 *
	 * @return  $this
	 */
	public static function getInstance($option = null)
	{
		$option = trim(strtolower($option));
		$option = $option ?: static::getActiveComponent();

		$class = get_called_class();

		if (empty(static::$instances[$class][$option]))
		{
			static::$instances[$class][$option] = new static($option);
		}

		return static::$instances[$class][$option];
	}

	/**
	 * Get the component prefix.
	 *
	 * @return  string
	 */
	public function getPrefix()
	{
		if (null === $this->prefix)
		{
			$parts = array_map(
				function ($part)
				{
					return ucfirst(strtolower($part));
				},
				explode('_', substr($this->option, 4))
			);

			$this->prefix = implode('_', $parts);
		}

		return $this->prefix;
	}

	/**
	 * Get a component table.
	 *
	 * @param   string   $name     Name of the table to load. Example: Article
	 * @param   array    $config   Optional array of configuration for the table
	 * @param   boolean  $backend  Search in backend folder?
	 *
	 * @return  \JTable
	 *
	 * @throws  \InvalidArgumentException  If table not found
	 */
	public function getTable($name, array $config = array(), $backend = true)
	{
		$prefix = $this->getPrefix() . 'Table';

		$baseFolder = $backend ? JPATH_ADMINISTRATOR : JPATH_SITE;

		\JTable::addIncludePath($baseFolder . '/components/' . $this->option . '/tables');

		$table = \JTable::getInstance($name, $prefix, $config);

		if (!$table instanceof \JTable)
		{
			throw new \InvalidArgumentException(
				sprintf('Cannot find the table %s in component %s.', $prefix . $name, $this->option)
			);
		}

		return $table;
	}

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
			->where('type = ' . $db->quote('component'))
			->where('element = ' . $db->q($this->option));

		$db->setQuery($query);

		return $db->loadObject() ?: new \stdClass;
	}

	/**
	 * Load parameters from database.
	 *
	 * @return  Registry
	 */
	protected function loadParams()
	{
		return new Registry($this->getExtensionProperty('params', array()));
	}
}
