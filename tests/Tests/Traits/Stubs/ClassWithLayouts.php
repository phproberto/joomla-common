<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Traits\Stubs;

use Phproberto\Joomla\Traits\HasLayouts;

/**
 * Sample class to test HasLayouts trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class ClassWithLayouts
{
	use HasLayouts;

	/**
	 * Get the data that will be sent to the layout.
	 *
	 * @param   boolean   $reload  Force reloading data
	 *
	 * @return  array
	 */
	protected function getLayoutData($reload = false)
	{
		return array(
			'title' => 'HasLayouts sample title'
		);
	}

	/**
	 * Get the paths where we will search for layouts.
	 *
	 * @return  string[]
	 */
	protected function getLayoutPaths()
	{
		return array(
			JPATH_TESTS_PHPROBERTO . '/files/templates/sample/html/layouts',
			JPATH_TESTS_PHPROBERTO . '/files/layouts'
		);
	}
}
