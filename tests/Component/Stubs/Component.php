<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Component\Stubs;

use Phproberto\Joomla\Entity\Entity;

use Phproberto\Joomla\Component\Component as BaseComponent;

/**
 * Custom Component class to ease testability.
 *
 * @since  __DEPLOY_VERSION__
 */
class Component extends BaseComponent
{
	/**
	 * Get the fake database extension.
	 *
	 * @return  \stdClass
	 */
	public static function databaseExtension()
	{
		return (object) array(
			'element' => 'com_phproberto',
			'name'    => 'com_phproberto',
			'params'  => '{"foo":"var"}',
			'type'    => 'component'
		);
	}

	/**
	 * Get the active component. Mainly for testing purposes.
	 *
	 * @return  string
	 */
	protected static function getActiveComponent()
	{
		return 'com_content';
	}

	/**
	 * Load extension from DB.
	 *
	 * @return  \stdClass
	 */
	protected function loadExtension()
	{
		return self::databaseExtension();
	}
}
