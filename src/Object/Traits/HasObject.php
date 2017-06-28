<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Object\Traits;

use Phproberto\Joomla\Object\Object;

defined('JPATH_PLATFORM') || die;

/**
 * Classes that have an associated object.
 *
 * @since  __DEPLOY_VERSION__
 */
trait HasObject
{
	/**
	 * Associated object.
	 *
	 * @var  \Phproberto\Joomla\Object\Object
	 */
	protected $object;

	/**
	 * Set value of an object property.
	 *
	 * @param   string  $property  Name of the property to set
	 * @param   mixed   $value     Value to assign
	 *
	 * @return  self
	 */
	public function assign($property, $value)
	{
		if (null === $this->object)
		{
			$this->object = new Object;
		}

		$this->object->assign($property, $value);

		return $this;
	}

	/**
	 * Bind data to the object.
	 *
	 * @param   array  $data  Data to bind
	 *
	 * @return  self
	 */
	public function bind(array $data)
	{
		if (null === $this->object)
		{
			$this->object = new Object;
		}

		$this->object->bind($data);

		return $this;
	}

	/**
	 * Retrieve all the values of the object.
	 *
	 * @return  array
	 */
	public function data()
	{
		return $this->object()->data();
	}

	/**
	 * Get property of the object
	 *
	 * @param   string  $property  Name of the property to retrieve
	 * @param   mixed   $default   Default value if property does not exist
	 *
	 * @return  mixed
	 */
	public function get($property, $default = null)
	{
		return $this->object()->get($property, $default);
	}

	/**
	 * Check if the object has a property.
	 *
	 * @param   string  $property  Name of the property to check for
	 *
	 * @return  boolean
	 */
	public function has($property)
	{
		return $this->object()->has($property);
	}

	/**
	 * Load object.
	 *
	 * @return  self
	 */
	public function loadObject()
	{
		$this->object = new Object($this->loadObjectData());

		return $this;
	}

	/**
	 * Load object data.
	 *
	 * @return  array
	 */
	abstract protected function loadObjectData();

	/**
	 * Get the associated object.
	 *
	 * @return  Entity
	 */
	public function object()
	{
		if (null === $this->object)
		{
			$this->loadObject();
		}

		return clone $this->object;
	}

	/**
	 * Set the object.
	 *
	 * @param   Object  $object  Value to assign
	 *
	 * @return  self
	 */
	public function setObject(Object $object)
	{
		$this->object = $object;

		return $this;
	}

	/**
	 * Unassign an object property.
	 *
	 * @param   string  $property  Name of the property to set
	 *
	 * @return  self
	 */
	public function unassign($property)
	{
		if (null === $this->object)
		{
			$this->object = new Object;
		}

		$this->object->unassign($property);

		return $this;
	}
}
