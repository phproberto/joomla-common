<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Traits;

defined('JPATH_PLATFORM') || die;

use Joomla\Registry\Registry;

/**
 * Trait for classes that have parameters.
 *
 * @since  0.0.1
 */
trait HasParams
{
	/**
	 * Module parameters.
	 *
	 * @var  Registry
	 */
	protected $params;

	/**
	 * Get a param value.
	 *
	 * @param   string  $name     Parameter name
	 * @param   mixed   $default  Optional default value, returned if the internal value is null.
	 *
	 * @return  mixed
	 */
	public function getParam($name, $default = null)
	{
		return $this->getParams()->get($name, $default);
	}

	/**
	 * Get the module parameters.
	 *
	 * @param   boolean  $reload  Force reloading data from DB.
	 *
	 * @return  Registry
	 */
	public function getParams($reload = false)
	{
		if ($reload || null === $this->params)
		{
			$this->params = $this->loadParams();
		}

		return clone $this->params;
	}

	/**
	 * Load parameters from database.
	 *
	 * @return  Registry
	 */
	abstract protected function loadParams();

	/**
	 * Set the value of a parameter.
	 *
	 * @param   string  $name   Parameter name
	 * @param   mixed   $value  Value to assign to selected parameter
	 *
	 * @return  self
	 */
	public function setParam($name, $value)
	{
		if (null === $this->params)
		{
			$this->params = $this->loadParams();
		}

		$this->params->set($name, $value);

		return $this;
	}

	/**
	 * Set the module parameters.
	 *
	 * @param   Registry  $params  Parameters to apply
	 *
	 * @return  self
	 */
	public function setParams(Registry $params)
	{
		$this->params = $params;

		return $this;
	}
}
