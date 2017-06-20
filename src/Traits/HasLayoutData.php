<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Traits;

defined('JPATH_PLATFORM') || die;

/**
 * Classes that have layout data.
 *
 * @since  __DEPLOY_VERSION__
 */
trait HasLayoutData
{
	/**
	 * Layout data.
	 *
	 * @var    array
	 */
	protected $layoutData = array();

	/**
	 * Get the data that will be sent to the layout.
	 *
	 * @param   boolean   $reload  Force reloading data
	 *
	 * @return  array
	 */
	protected function getLayoutData($reload = false)
	{
		if ($reload || !isset($this->layoutData[__CLASS__]))
		{
			$this->layoutData[__CLASS__] = $this->loadLayoutData();
		}

		return $this->layoutData[__CLASS__];
	}

	/**
	 * Load layout data.
	 *
	 * @return  self
	 */
	abstract protected function loadLayoutData();
}
