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
 * Base client.
 *
 * @since  __DEPLOY_VERSION__
 */
abstract class BaseClient implements ClientInterface
{
	/**
	 * Client identifier.
	 *
	 * @var  integer
	 */
	protected $id;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->id = static::ID;
	}

	/**
	 * Get client identifier.
	 *
	 * @return  integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get client name
	 *
	 * @return  string
	 */
	public function getName()
	{
		return static::NAME;
	}

	/**
	 * Is this admin client?
	 *
	 * @return  boolean
	 */
	public function isAdmin()
	{
		return $this->id === Administrator::ID;
	}

	/**
	 * Is this site client?
	 *
	 * @return  boolean
	 */
	public function isSite()
	{
		return $this->id === Site::ID;
	}
}
