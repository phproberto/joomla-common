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
 * Describes methods required by modules.
 *
 * @since  0.0.1
 */
interface ClientInterface
{
	/**
	 * Site client identifier.
	 *
	 * @const
	 */
	const ID_SITE = 0;

	/**
	 * Administrator client identifier.
	 *
	 * @const
	 */
	const ID_ADMIN = 1;

	/**
	 * Get the base folder of this client.
	 *
	 * @return  string
	 */
	public function getFolder();

	/**
	 * Get the identifier.
	 *
	 * @return  integer
	 */
	public function getId();

	/**
	 * Get the name
	 *
	 * @return  string
	 */
	public function getName();

	/**
	 * Is this admin client?
	 *
	 * @return  boolean
	 */
	public function isAdmin();

	/**
	 * Is this site client?
	 *
	 * @return  boolean
	 */
	public function isSite();
}
