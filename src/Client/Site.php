<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Client;

defined('_JEXEC') || die;

/**
 * Frontend client.
 *
 * @since  __DEPLOY_VERSION__
 */
final class Site extends BaseClient
{
	/**
	 * Client identifier.
	 *
	 * @const
	 */
	const ID = 0;

	/**
	 * Client name.
	 *
	 * @const
	 */
	const NAME = 'Site';

	/**
	 * Get the base folder of this client.
	 *
	 * @return  string
	 */
	public function getFolder()
	{
		return JPATH_SITE;
	}
}
