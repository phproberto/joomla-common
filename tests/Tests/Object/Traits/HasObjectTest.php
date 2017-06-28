<?php
/**
 * Virtual storage for objects.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Tests\Object;

use Phproberto\Joomla\Object\Object;
use Phproberto\Joomla\Tests\Object\Traits\Stubs\ClassWithObject;

/**
 * HasObject test.
 *
 * @since   __DEPLOY_VERSION__
 */
class HasObjectTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Constructor works.
	 *
	 * @return  void
	 */
	public function testBindSetsCorrectData()
	{
		$class = new ClassWithObject;

		$reflection = new \ReflectionClass($class);
		$objectProperty = $reflection->getProperty('object');
		$objectProperty->setAccessible(true);

		$this->assertSame(null, $objectProperty->getValue($class));

		$data = ['id' => 999, 'name' => 'Roberto Segura'];

		$class->bind($data);

		$object = $objectProperty->getValue($class);

		$objectReflection = new \ReflectionClass($object);
		$dataProperty = $objectReflection->getProperty('data');
		$dataProperty->setAccessible(true);

		$this->assertSame($data, $dataProperty->getValue($object));
	}

	/**
	 * data returns correct data.
	 *
	 * @return  void
	 */
	public function testDataReturnsCorrectData()
	{
		$class = new ClassWithObject;

		$this->assertSame([], $class->data());

		$data = ['id' => 999, 'name' => 'Roberto Segura'];

		$class->bind($data);

		$this->assertSame($data, $class->data());
	}
	/**
	 * get returns correct object property.
	 *
	 * @return  void
	 */
	public function testGetReturnsCorrectObjectProperty()
	{
		$class = new ClassWithObject;

		$this->assertEquals(null, $class->get('id'));

		$reflection = new \ReflectionClass($class);
		$objectProperty = $reflection->getProperty('object');
		$objectProperty->setAccessible(true);

		$object = new Object(['id' => 999, 'name' => 'Roberto Segura']);

		$objectProperty->setValue($class, $object);

		$this->assertEquals(999, $class->get('id'));
		$this->assertEquals('Roberto Segura', $class->get('name'));
		$this->assertEquals(null, $class->get('unexisting'));
	}

	/**
	 * has returns correct value.
	 *
	 * @return  void
	 */
	public function testHasReturnsCorrectValue()
	{
		$class = new ClassWithObject;

		$this->assertFalse($class->has('id'));

		$reflection = new \ReflectionClass($class);
		$objectProperty = $reflection->getProperty('object');
		$objectProperty->setAccessible(true);

		$object = new Object(['id' => 999, 'name' => 'Roberto Segura']);

		$objectProperty->setValue($class, $object);

		$this->assertTrue($class->has('id'));
		$this->assertTrue($class->has('name'));
		$this->assertFalse( $class->has('unexisting'));
	}

	/**
	 * object returns correct data.
	 *
	 * @return  void
	 */
	public function testObjectReturnsCorrectData()
	{
		$class = new ClassWithObject;

		$this->assertEquals(new Object, $class->object());

		$reflection = new \ReflectionClass($class);
		$objectProperty = $reflection->getProperty('object');
		$objectProperty->setAccessible(true);

		$object = new Object(['id' => 999, 'name' => 'Roberto Segura']);

		$objectProperty->setValue($class, $object);

		$this->assertEquals($object, $class->object());
	}

	/**
	 * assign sets correct object value.
	 *
	 * @return  void
	 */
	public function testAssignSetsCorrectObjectValue()
	{
		$class = new ClassWithObject;

		$reflection = new \ReflectionClass($class);
		$objectProperty = $reflection->getProperty('object');
		$objectProperty->setAccessible(true);

		$this->assertEquals(null, $objectProperty->getValue($class));

		$class->assign('id', 999);
		$class->assign('name', 'Roberto Segura');

		$object = $objectProperty->getValue($class);
		$objectReflection = new \ReflectionClass($object);
		$dataProperty = $objectReflection->getProperty('data');
		$dataProperty->setAccessible(true);

		$this->assertEquals(999, $dataProperty->getValue($object)['id']);
		$this->assertEquals('Roberto Segura', $dataProperty->getValue($object)['name']);
	}

	/**
	 * setObject sets full object value.
	 *
	 * @return  void
	 */
	public function testSetObjectSetsFullObjectValue()
	{
		$class = new ClassWithObject;

		$reflection = new \ReflectionClass($class);
		$objectProperty = $reflection->getProperty('object');
		$objectProperty->setAccessible(true);

		$this->assertEquals(null, $objectProperty->getValue($class));

		$object = new Object(['id' => 999, 'name' => 'Roberto Segura']);

		$class->setObject($object);

		$this->assertEquals($object, $objectProperty->getValue($class));
	}

	/**
	 * unassign unsets property.
	 *
	 * @return  void
	 */
	public function testUnassignUnsetsObjectProperty()
	{
		$class = new ClassWithObject;

		$reflection = new \ReflectionClass($class);
		$objectProperty = $reflection->getProperty('object');
		$objectProperty->setAccessible(true);

		$this->assertEquals(null, $objectProperty->getValue($class));

		$class->unassign('sample');

		$this->assertEquals(new Object, $objectProperty->getValue($class));

		$object = new Object(['id' => 999, 'name' => 'Roberto Segura']);

		$objectProperty->setValue($class, $object);

		$this->assertEquals($object, $objectProperty->getValue($class));

		$object = $objectProperty->getValue($class);
		$objectReflection = new \ReflectionClass($object);
		$dataProperty = $objectReflection->getProperty('data');
		$dataProperty->setAccessible(true);

		$this->assertTrue(array_key_exists('id', $dataProperty->getValue($object)));
		$this->assertTrue(array_key_exists('name', $dataProperty->getValue($object)));

		$class->unassign('id');

		$this->assertFalse(array_key_exists('id', $dataProperty->getValue($object)));
		$this->assertTrue(array_key_exists('name', $dataProperty->getValue($object)));

		$class->unassign('name');

		$this->assertFalse(array_key_exists('id', $dataProperty->getValue($object)));
		$this->assertFalse(array_key_exists('name', $dataProperty->getValue($object)));
	}
}
