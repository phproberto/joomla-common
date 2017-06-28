<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Object\Traits\Stubs;

use Phproberto\Joomla\Object\Traits\HasObject;

/**
 * Sample class to test HasExtension trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class ClassWithObject
{
	use HasObject;

	/**
	 * Load info from database.
	 *
	 * @return  array
	 */
	protected function loadData()
	{
		return [];
	}
}
