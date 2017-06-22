<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Client;

use Phproberto\Joomla\Client\Site;

/**
 * Tests for Site client.
 *
 * @since  __DEPLOY_VERSION__
 */
class SiteTest extends \TestCase
{
	/**
	 * Test getFolder returns the correct folder.
	 *
	 * @return  void
	 */
	public function testGetFolderReturnsCorrectFolder()
	{
		$client = new Site;
		$this->assertEquals(JPATH_SITE, $client->getFolder());
	}

	/**
	 * Test getId returns the correct id.
	 *
	 * @return  void
	 */
	public function testGetIdReturnsCorrectId()
	{
		$client = new Site;
		$this->assertEquals(Site::ID, $client->getId());
	}

	/**
	 * Test getName returns correct name.
	 *
	 * @return  void
	 */
	public function testGetNameRetursCorrectName()
	{
		$client = new Site;
		$this->assertEquals(Site::NAME, $client->getName());
	}

	/**
	 * Test isAdmin returns false.
	 *
	 * @return  void
	 */
	public function testIsAdminReturnsFalse()
	{
		$client = new Site;
		$this->assertFalse($client->IsAdmin());
	}

	/**
	 * Test isSite returns true.
	 *
	 * @return  void
	 */
	public function testIsSiteReturnsTrue()
	{
		$client = new Site;
		$this->assertTrue($client->IsSite());
	}
}
