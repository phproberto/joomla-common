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
		return DatabaseExtension::get();
	}
}
