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
 * Client selector.
 *
 * @since  __DEPLOY_VERSION__
 */
abstract class Client
{
	/**
	 * Retrieve the active client.
	 *
	 * @return  ClientInterface
	 */
	public static function active()
	{
		return \JFactory::getApplication()->isAdmin() ? self::admin() : self::site();
	}

	/**
	 * Retrieve admin client.
	 *
	 * @return  Admin
	 */
	public static function admin()
	{
		return new Administrator;
	}

	/**
	 * Retrieve site client.
	 *
	 * @return  Site
	 */
	public static function site()
	{
		return new Site;
	}
}
