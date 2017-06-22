<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Client;

use Phproberto\Joomla\Client\Administrator;
use Phproberto\Joomla\Client\Client;
use Phproberto\Joomla\Client\Site;

/**
 * Tests for HasExtension trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class ClientTest extends \TestCase
{
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->saveFactoryState();

		$app = $this->getMockCmsApp();

		\JFactory::$application = $app;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return  void
	 */
	protected function tearDown()
	{
		$this->restoreFactoryState();

		parent::tearDown();
	}

	/**
	 * Test administrator client can be retrieved.
	 *
	 * @return  void
	 */
	public function testAdminReturnsAdminClient()
	{
		$client = Client::admin();
		$this->assertEquals(get_class($client), get_class(new Administrator));
	}

	/**
	 * Test getActive return site client when active application is site.
	 *
	 * @return  void
	 */
	public function testGetActiveReturnsSiteClient()
	{
		$this->getMockCmsApp()
			->method('isAdmin')
			->willReturn(false);

		$client = Client::active();
		$this->assertEquals(get_class($client), get_class(new Site));
	}

	/**
	 * Test getActive return site client when active application is site.
	 *
	 * @return  void
	 */
	public function testGetActiveReturnsAdminClient()
	{
		$this->getMockCmsApp()
			->method('isAdmin')
			->willReturn(true);

		$client = Client::active();
		$this->assertEquals(get_class($client), get_class(new Site));
	}

	/**
	 * Test site client can be retrieved.
	 *
	 * @return  void
	 */
	public function testSiteReturnsSiteClient()
	{
		$client = Client::site();
		$this->assertEquals(get_class($client), get_class(new Site));
	}
}
