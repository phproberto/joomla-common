<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Traits;

use Joomla\Registry\Registry;
use Phproberto\Joomla\Tests\Traits\Stubs\ClassWithParams;

/**
 * Tests for HasParams trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class HasParamsTest extends \TestCase
{
	/**
	 * Test getParam method.
	 *
	 * @return  void
	 */
	public function testGetParam()
	{
		$class = new ClassWithParams;
		$this->assertEquals('var', $class->getParam('foo'));
		$this->assertEquals(null, $class->getParam('custom-param'));
		$this->assertEquals('default-value', $class->getParam('custom-param', 'default-value'));
		$this->assertEquals(array('test' => 'me'), $class->getParam('custom-param', array('test' => 'me')));
	}

	/**
	 * Test getParams method.
	 *
	 * @return  void
	 */
	public function testGetParams()
	{
		$class = new ClassWithParams;
		$this->assertEquals(ClassWithParams::defaultParams(), $class->getParams());

		$reflection = new \ReflectionClass($class);
		$params = $reflection->getProperty('params');
		$params->setAccessible(true);

		$modifiedParams = $params->getValue($class);
		$modifiedParams->set('custom-param', 'my-value');

		$params->setValue($class, $modifiedParams);
		$this->assertEquals($modifiedParams, $class->getParams());
		$this->assertNotEquals(ClassWithParams::defaultParams(), $class->getParams());
		$this->assertEquals(ClassWithParams::defaultParams(), $class->getParams(true));
	}

	/**
	 * Test saveParams. This is a test to guide the recommended approach to save params.
	 *
	 * @return  void
	 */
	public function testSaveParams()
	{
		$class = new ClassWithParams;
		$this->assertEquals(ClassWithParams::defaultParams(), $class->getParams());

		$reflection = new \ReflectionClass($class);
		$params = $reflection->getProperty('params');
		$params->setAccessible(true);

		$modifiedParams = $params->getValue($class);
		$modifiedParams->set('custom-param', 'my-value');

		$class->saveParams();
		$this->assertEquals($modifiedParams, $class->getParams());

		$modifiedParams->set('another-one', 'another-value');
		$this->assertNotEquals($modifiedParams, $class->getParams());
		$class->saveParams($modifiedParams);
		$this->assertEquals($modifiedParams, $class->getParams());
	}

	/**
	 * Test setParam method.
	 *
	 * @return  void
	 */
	public function testSetParam()
	{
		$class = new ClassWithParams;
		$this->assertEquals(ClassWithParams::defaultParams(), $class->getParams());
		$class->setParam('foo', 'var-modified');
		$this->assertNotEquals(ClassWithParams::defaultParams(), $class->getParams());
		$this->assertEquals('var-modified', $class->getParam('foo'));
		$class->setParam('foo', null);
		$this->assertEquals(null, $class->getParam('foo'));

		$class2 = new ClassWithParams;
		$class2->setParam('custom', 'value');
		$this->assertEquals('var', $class2->getParam('foo'));
		$this->assertEquals('value', $class2->getParam('custom'));
	}

	/**
	 * Test setParams method.
	 *
	 * @return  void
	 */
	public function testSetParams()
	{
		$class = new ClassWithParams;
		$this->assertEquals(ClassWithParams::defaultParams(), $class->getParams());
		$this->assertEquals('var', $class->getParam('foo'));

		$customParams = new Registry(array('testSetParams' => 'test'));
		$class->setParams($customParams);
		$this->assertEquals($customParams, $class->getParams());
		$this->assertNotEquals('var', $class->getParam('foo'));
		$this->assertEquals('test', $class->getParam('testSetParams'));
	}
}
