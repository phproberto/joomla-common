<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Traits\Stubs;

use Joomla\Registry\Registry;
use Phproberto\Joomla\Traits\HasParams;

/**
 * Sample class to test HasParams trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class ClassWithParams
{
	use HasParams;

	/**
	 * Parameters saved to the database.
	 *
	 * @var  Registry
	 */
	public $savedParams;

	/**
	 * Get the default layout data.
	 *
	 * @return  array
	 */
	public static function defaultParams()
	{
		return new Registry(
			array(
				'foo'    => 'var',
				'layout' => 'data'
			)
		);
	}

	/**
	 * Load parameters from database.
	 *
	 * @return  Registry
	 */
	protected function loadParams()
	{
		return self::defaultParams();
	}

	/**
	 * Save parameters to database.
	 *
	 * @param   Registry  $params  Optional parameters. Null to use current ones.
	 *
	 * @return  Registry
	 */
	public function saveParams($params = null)
	{
		$params = null !== $params ? $params : $this->getParams();

		if (!$params instanceof \Joomla\Registry\Registry)
		{
			throw new \InvalidArgumentException(__CLASS__ . '::' . __METHOD__ . ' requires a Registry instance. ' . gettype($params) . ' received.');
		}

		$this->setParams($params);

		return true;
	}
}
