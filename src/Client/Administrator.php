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
 * Backend client.
 *
 * @since  __DEPLOY_VERSION__
 */
final class Administrator extends BaseClient implements ClientInterface
{
	/**
	 * Client identifier.
	 *
	 * @const
	 */
	const ID = 1;

	/**
	 * Client name.
	 *
	 * @const
	 */
	const NAME = 'Administrator';

	/**
	 * Get the base folder of this client.
	 *
	 * @return  string
	 */
	public function getFolder()
	{
		return JPATH_ADMINISTRATOR;
	}
}
