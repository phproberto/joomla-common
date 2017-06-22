<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Traits;

use Phproberto\Joomla\Tests\Traits\Stubs\AnotherClassWithInstances;
use Phproberto\Joomla\Tests\Traits\Stubs\ClassWithInstances;

/**
 * Tests for HasInstances trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class HasInstancesTest extends \TestCase
{
	/**
	 * Test constructor.
	 *
	 * @return  void
	 */
	public function testConstructor()
	{
		$class = new ClassWithInstances(1337);

		$this->assertEquals(1337, $class->getId());
		$class->setName('Sample name');
		$this->assertEquals('Sample name', $class->getName());

		$class2 = new ClassWithInstances(1337);
		$this->assertNotEquals('Sample name', $class2->getName());
	}

	/**
	 * Test clearInstance method.
	 *
	 * @return  void
	 */
	public function testClearInstance()
	{
		$class = ClassWithInstances::getInstance(1337);
		$class->setName('Sample name');
		$this->assertEquals('Sample name', $class->getName());

		$class2 = ClassWithInstances::getInstance(1337);
		$this->assertEquals('Sample name', $class2->getName());

		ClassWithInstances::clearInstance(1337);

		$class3 = ClassWithInstances::getInstance(1337);
		$this->assertNotEquals('Sample name', $class3->getName());
	}

	/**
	 * Test getFreshInstance method.
	 *
	 * @return  void
	 */
	public function testGetFreshInstance()
	{
		$class = ClassWithInstances::getInstance(1337);
		$class->setName('Sample name');
		$this->assertEquals('Sample name', $class->getName());

		$class3 = ClassWithInstances::getFreshInstance(1337);
		$this->assertNotEquals('Sample name', $class3->getName());
	}

	/**
	 * Test getInstance method.
	 *
	 * @return  void
	 */
	public function testGetInstance()
	{
		$class = ClassWithInstances::getInstance(1337);
		$class->setName('Sample name');
		$this->assertEquals('Sample name', $class->getName());

		$class2 = ClassWithInstances::getInstance(1337);
		$this->assertEquals('Sample name', $class2->getName());
	}

	/**
	 * Test that different classes using the same id.
	 *
	 * @return  void
	 */
	public function testNoCollisionsBetweenClasses()
	{
		$class = ClassWithInstances::getInstance(1337);
		$class->setName('Sample name');
		$this->assertEquals('Sample name', $class->getName());

		$class2 = AnotherClassWithInstances::getInstance(1337);
		$this->assertNotEquals('Sample name', $class2->getName());

		$class3 = ClassWithInstances::getInstance(1337);
		$this->assertEquals('Sample name', $class3->getName());
	}
}
