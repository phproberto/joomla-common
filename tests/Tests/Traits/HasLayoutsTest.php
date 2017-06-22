<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Traits;

use Phproberto\Joomla\Tests\Traits\Stubs\ClassWithLayouts;

/**
 * Tests for HasLayouts trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class HasLayoutsTest extends \TestCase
{
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->saveFactoryState();

		$app = $this->getMockCmsApp();

		$app->expects($this->any())
			->method('getTemplate')
			->will($this->returnValue('sample'));

		\JFactory::$application = $app;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
		$this->restoreFactoryState();

		parent::tearDown();
	}

	/**
	 * Test debug method.
	 *
	 * @return  void
	 */
	public function testDebug()
	{
		$class = new ClassWithLayouts;
		$debugText = '';
		ob_start();
		$content = trim($class->debug('haslayouts.default'));
		$debugText = ob_get_contents();
		ob_end_clean();
		$this->assertEquals('<h1>HasLayouts sample title</h1>', $content);
		$this->assertContains('<pre>', $debugText);
	}

	/**
	 * Test render method.
	 *
	 * @return  void
	 */
	public function testRender()
	{
		$class = new ClassWithLayouts;
		$this->assertEquals('<h1>Sample layout</h1>', trim($class->render()));
		$this->assertEquals('<h1>HasLayouts sample title</h1>', trim($class->render('haslayouts.default')));
		$this->assertEquals('<h1>HasLayouts overriden title</h1>', trim($class->render('haslayouts.default', array('title' => 'HasLayouts overriden title'))));
		$this->assertEquals('<h1>$diplayData contains 1 items</h1>', trim($class->render('haslayouts.count', array('title' => 'HasLayouts overriden title'))));
		$this->assertEquals('<h1>$diplayData contains 3 items</h1>', trim($class->render('haslayouts.count', array('foo' => 'var', 'int' => 22))));
		$this->assertEquals('<h1>HasLayouts sample title overriden</h1>', trim($class->render('haslayouts.overriden')));
	}
}
