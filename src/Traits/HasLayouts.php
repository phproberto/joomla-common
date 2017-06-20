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
 * Modules that use JLayoutFile as renderer.
 *
 * @since  0.0.1
 */
trait HasLayouts
{
	/**
	 * Debug a layout rendering.
	 *
	 * @param   string  $layoutId  Layout identifier
	 * @param   array   $data      Optional data for the layout
	 *
	 * @return  string
	 */
	public function debug($layoutId = null, $data = array())
	{
		$layoutId = $layoutId ?: 'default';

		$renderer = new \JLayoutFile($layoutId);
		$renderer->setIncludePaths($this->getLayoutPaths());

		return $renderer->debug(array_merge($this->getLayoutData(), $data));
	}

	/**
	 * Get the data that will be sent to the layout.
	 *
	 * @param   boolean   $reload  Force reloading data
	 *
	 * @return  array
	 */
	abstract protected function getLayoutData($reload = false);

	/**
	 * Get the paths where we will search for layouts.
	 *
	 * @return  string[]
	 */
	abstract protected function getLayoutPaths();

	/**
	 * Render a layout.
	 *
	 * @param   string  $layoutId  Layout identifier
	 * @param   array   $data      Optional data for the layout
	 *
	 * @return  string
	 */
	public function render($layoutId = null, $data = array())
	{
		$layoutId = $layoutId ?: 'default';

		$renderer = new \JLayoutFile($layoutId);
		$renderer->setIncludePaths($this->getLayoutPaths());

		return $renderer->render(array_merge($this->getLayoutData(), $data));
	}
}
