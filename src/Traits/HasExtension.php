<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Traits;

use Joomla\Registry\Registry;

defined('JPATH_PLATFORM') || die;

/**
 * Trait to for classes linked to a DB extension.
 *
 * @since  0.0.1
 */
trait HasExtension
{
	/**
	 * Extension information from DB.
	 *
	 * @var  \stdClass
	 */
	protected $extension;

	/**
	 * Get the extension information.
	 *
	 * @param   boolean  $reload  Force reloading?
	 *
	 * @return  \stdClass
	 */
	public function getExtension($reload = false)
	{
		if ($reload || null === $this->extension)
		{
			$this->extension = $this->loadExtension();
		}

		return clone $this->extension;
	}

	/**
	 * Get an extension property.
	 *
	 * @param   string  $property  Name of the property
	 * @param   mixed   $default   Default value
	 *
	 * @return  mixed
	 */
	public function getExtensionProperty($property, $default = null)
	{
		$extension = new Registry((array) $this->getExtension());

		return $extension->get($property, $default);
	}

	/**
	 * Load extension from DB.
	 *
	 * @return  \stdClass
	 */
	abstract protected function loadExtension();
}
