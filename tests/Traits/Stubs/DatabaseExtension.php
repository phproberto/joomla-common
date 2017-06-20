<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Traits\Stubs;

use Joomla\Registry\Registry;

/**
 * Fake database extension.
 *
 * @since  __DEPLOY_VERSION__
 */
abstract class DatabaseExtension
{
	/**
	 * Get default extension data.
	 *
	 * @return  \stdClass
	 */
	public static function get()
	{
		return (object) array(
			'extension_id'     => 1337,
			'package_id'       => 0,
			'name'             => 'lib_fake',
			'type'             => 'library',
			'element'          => 'fake',
			'folder'           => '',
			'client_id'        => 0,
			'enabled'          => 1,
			'access'           => 1,
			'manifest_cache'   => '{"name": "lib_fake", "type": "library", "filename" : "fake"}',
			'params'           => '{}',
			'custom_data'      => '',
			'system_datas'     => '',
			'checked_out'      => 0,
			'checked_out_time' => '0000-00-00 00:00:00',
			'ordering'         => 0,
			'state'            => 0
		);
	}

	/**
	 * Get the value of a specific property
	 *
	 * @param   string  $property  [description]
	 * @param   mixed   $default   [description]
	 *
	 * @return  mixed
	 */
	public static function getProperty($property, $default = null)
	{
		$data = new Registry((array) self::get());

		return $data->get($property, $default);
	}
}
