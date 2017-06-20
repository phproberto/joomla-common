<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Traits;

defined('JPATH_PLATFORM') or die;

/**
 * Classes using multiple singleton instances.
 *
 * @since  __DEPLOY_VERSION__
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
		$class = get_called_class();

		unset(static::$instances[$class][$id]);
	}

	/**
	 * Create and return a cached instance
	 *
	 * @param   integer  $id  Identifier of the active instance
	 *
	 * @return  $this
	 */
	public static function getInstance($id)
	{
		$class = get_called_class();

		if (empty(static::$instances[$class][$id]))
		{
			static::$instances[$class][$id] = new static($id);
		}

		return static::$instances[$class][$id];
	}
}
