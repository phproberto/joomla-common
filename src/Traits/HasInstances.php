<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Traits;

defined('JPATH_PLATFORM') || die;

/**
 * Classes using multiple singleton instances.
 *
 * @since  0.0.1
 */
trait HasInstances
{
	/**
	 * Cached instances
	 *
	 * @var  array
	 */
	protected static $instances = array();

	/**
	 * Remove an instance from cache.
	 *
	 * @param   integer  $id  Class identifier
	 *
	 * @return  void
	 */
	public static function clearInstance($id)
	{
		unset(static::$instances[get_called_class()][$id]);
	}

	/**
	 * Clear all instances from cache
	 *
	 * @return  void
	 */
	public static function clearAllInstances()
	{
		unset(static::$instances[get_called_class()]);
	}

	/**
	 * Ensure that we retrieve a non-statically-cached instance.
	 *
	 * @param   integer  $id   Identifier of the instance
	 *
	 * @return  $this
	 */
	public static function freshInstance($id)
	{
		static::clearInstance($id);

		return static::instance($id);
	}

	/**
	 * Create and return a cached instance
	 *
	 * @param   integer  $id  Identifier of the instance
	 *
	 * @return  $this
	 */
	public static function instance($id)
	{
		$class = get_called_class();

		if (empty(static::$instances[$class][$id]))
		{
			static::$instances[$class][$id] = new static($id);
		}

		return static::$instances[$class][$id];
	}
}
