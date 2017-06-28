<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Object;

/**
 * Object class
 *
 * @since   __DEPLOY_VERSION__
 */
class Object
{
	/**
	 * Stored entity.
	 *
	 * @var  array
	 */
	protected $data;

	/**
	 * Constructor.
	 *
	 * @param   array  $data  Object data
	 */
	public function __construct(array $data = [])
	{
		$this->data = $data ? $data : [];
	}

	/**
	 * Retrieve all the values of the object.
	 *
	 * @return  array
	 */
	public function data()
	{
		return $this->data;
	}

	/**
	 * Bind data to the object.
	 *
	 * @param   mixed  $data  Array | Object
	 *
	 * @return  self
	 */
	public function bind($data)
	{
		$data = (array) $data;

		foreach ($data as $property => $value)
		{
			$this->data[$property] = $value;
		}

		return $this;
	}

	/**
	 * Clear stored object.
	 *
	 * @return  self
	 */
	public function clear()
	{
		$this->data = [];

		return $this;
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
		if (!$this->has($property))
		{
			return $default;
		}

		return null !== $this->data[$property] ? $this->data[$property] : $default;
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
		return array_key_exists($property, $this->data);
	}

	/**
	 * Show available properties.
	 *
	 * @return  array
	 */
	public function properties()
	{
		return array_keys($this->data);
	}

	/**
	 * Set value of an objet property.
	 *
	 * @param   string  $property  Name of the property to set
	 * @param   mixed   $value     Value to assign
	 *
	 * @return  self
	 */
	public function set($property, $value)
	{
		$this->data[$property] = $value;

		return $this;
	}

	/**
	 * Set data.
	 *
	 * @param   array  $data  Data
	 *
	 * @return  self
	 */
	public function setData(array $data)
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * Unsets an object property in the storage.
	 *
	 * @param   string  $property  Name of the property to set
	 *
	 * @return  self
	 */
	public function unset($property)
	{
		unset($this->data[$property]);

		return $this;
	}
}
