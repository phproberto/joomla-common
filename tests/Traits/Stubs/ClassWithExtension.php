<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Traits\Stubs;

use Phproberto\Joomla\Traits\HasExtension;

/**
 * Sample class to test HasExtension trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class ClassWithExtension
{
	use HasExtension;

	/**
	 * Load extension from db.
	 *
	 * @return  stdClass
	 */
	protected function loadExtension()
	{
		return self::defaultExtension();
	}

	/**
	 * Get default extension data.
	 *
	 * @return  \stdClass
	 */
	public static function defaultExtension()
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
}
