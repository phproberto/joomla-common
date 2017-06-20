<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Traits\Stubs;

use Phproberto\Joomla\Traits\HasLayoutData;

/**
 * Sample class to test HasLayoutData trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class ClassWithLayoutData
{
	use HasLayoutData;

	/**
	 * Load extension from db.
	 *
	 * @return  stdClass
	 */
	protected function loadLayoutData()
	{
		return self::defaultLayoutData();
	}

	/**
	 * Get the default layout data.
	 *
	 * @return  array
	 */
	public static function defaultLayoutData()
	{
		return array(
			'foo'    => 'var',
			'layout' => 'data'
		);
	}

	/**
	 * Public method to allow access to layoutData for testing purposes.
	 *
	 * @param   boolean  $reload  Force reloading data
	 *
	 * @return  array
	 */
	public function getData($reload = false)
	{
		return $this->getLayoutData($reload);
	}
}
