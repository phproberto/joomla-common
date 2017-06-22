<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Client;

use Phproberto\Joomla\Client\Administrator;

/**
 * Tests for Administrator client.
 *
 * @since  __DEPLOY_VERSION__
 */
class AdministratorTest extends \TestCase
{
	/**
	 * Test getFolder returns the correct folder.
	 *
	 * @return  void
	 */
	public function testGetFolderReturnsCorrectFolder()
	{
		$client = new Administrator;
		$this->assertEquals(JPATH_ADMINISTRATOR, $client->getFolder());
	}

	/**
	 * Test getId returns the correct id.
	 *
	 * @return  void
	 */
	public function testGetIdReturnsCorrectId()
	{
		$client = new Administrator;
		$this->assertEquals(Administrator::ID, $client->getId());
	}

	/**
	 * Test getName returns correct name.
	 *
	 * @return  void
	 */
	public function testGetNameRetursCorrectName()
	{
		$client = new Administrator;
		$this->assertEquals(Administrator::NAME, $client->getName());
	}

	/**
	 * Test isAdmin returns true.
	 *
	 * @return  void
	 */
	public function testIsAdminReturnsTrue()
	{
		$client = new Administrator;
		$this->assertTrue($client->IsAdmin());
	}

	/**
	 * Test isAdmin returns false.
	 *
	 * @return  void
	 */
	public function testIsSiteReturnsFalse()
	{
		$client = new Administrator;
		$this->assertFalse($client->IsSite());
	}
}
