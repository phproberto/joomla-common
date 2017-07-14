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
	 * param returns correct value.
	 *
	 * @return  void
	 */
	public function testParamReturnsCorrectValue()
	{
		$class = new ClassWithParams;
		$this->assertEquals('var', $class->param('foo'));
		$this->assertEquals(null, $class->param('custom-param'));
		$this->assertEquals('default-value', $class->param('custom-param', 'default-value'));
		$this->assertEquals(array('test' => 'me'), $class->param('custom-param', array('test' => 'me')));
	}

	/**
	 * params return correct value.
	 *
	 * @return  void
	 */
	public function testParams()
	{
		$class = new ClassWithParams;
		$this->assertEquals(ClassWithParams::defaultParams(), $class->params());

		$reflection = new \ReflectionClass($class);
		$params = $reflection->getProperty('params');
		$params->setAccessible(true);

		$modifiedParams = $params->getValue($class);
		$modifiedParams->set('custom-param', 'my-value');

		$params->setValue($class, $modifiedParams);
		$this->assertEquals($modifiedParams, $class->params());
		$this->assertNotEquals(ClassWithParams::defaultParams(), $class->params());
		$this->assertEquals(ClassWithParams::defaultParams(), $class->params(true));
	}

	/**
	 * Test setParam method.
	 *
	 * @return  void
	 */
	public function testSetParam()
	{
		$class = new ClassWithParams;
		$this->assertEquals(ClassWithParams::defaultParams(), $class->params());
		$class->setParam('foo', 'var-modified');
		$this->assertNotEquals(ClassWithParams::defaultParams(), $class->params());
		$this->assertEquals('var-modified', $class->param('foo'));
		$class->setParam('foo', null);
		$this->assertEquals(null, $class->param('foo'));

		$class2 = new ClassWithParams;
		$class2->setParam('custom', 'value');
		$this->assertEquals('var', $class2->param('foo'));
		$this->assertEquals('value', $class2->param('custom'));
	}

	/**
	 * Test setParams method.
	 *
	 * @return  void
	 */
	public function testSetParams()
	{
		$class = new ClassWithParams;
		$this->assertEquals(ClassWithParams::defaultParams(), $class->params());
		$this->assertEquals('var', $class->param('foo'));

		$customParams = new Registry(array('testSetParams' => 'test'));
		$class->setParams($customParams);
		$this->assertEquals($customParams, $class->params());
		$this->assertNotEquals('var', $class->param('foo'));
		$this->assertEquals('test', $class->param('testSetParams'));
	}
}
