<?php
/**
 * Virtual storage for objects.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Tests\Object;

use Phproberto\Joomla\Object\Object;

/**
 * Object test.
 *
 * @since   __DEPLOY_VERSION__
 */
class ObjectTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Constructor sets the correct data.
	 *
	 * @return  void
	 */
	public function testConstructorSetsCorrectData()
	{
		$object = new Object;

		$reflection = new \ReflectionClass($object);
		$dataProperty = $reflection->getProperty('data');
		$dataProperty->setAccessible(true);

		$this->assertEquals([], $dataProperty->getValue($object));

		$data = ['id' => 23, 'name' => 'Roberto Segura'];
		$object = new Object($data);

		$this->assertEquals($data, $dataProperty->getValue($object));
	}

	/**
	 * data returns all the values.
	 *
	 * @return  void
	 */
	public function testDataReturnsCorrectValues()
	{
		$object = new Object;

		$this->assertEquals([], $object->data());

		$data = ['id' => 23, 'name' => 'Roberto Segura'];

		$object = new Object($data);

		$this->assertEquals($data, $object->data());
	}

	/**
	 * bind method sets the correct values.
	 *
	 * @return  void
	 */
	public function testBindSetsCorrectValues()
	{
		$object = new Object;

		$reflection = new \ReflectionClass($object);
		$dataProperty = $reflection->getProperty('data');
		$dataProperty->setAccessible(true);

		$this->assertEquals([], $dataProperty->getValue($object));
		$initialData = ['id' => 27, 'name' => 'Isidro Baquero'];
		$extraData = ['id' => 999, 'age' => 40];
		$finalData = ['id' => 999, 'name' => 'Isidro Baquero', 'age' => 40];

		$object->bind($initialData);

		$this->assertEquals($initialData, $dataProperty->getValue($object));

		$object->bind($extraData);

		$this->assertEquals($finalData, $dataProperty->getValue($object));
	}

	/**
	 * clear removes all the data.
	 *
	 * @return  void
	 */
	public function testClearRemovesAllTheData()
	{
		$data = ['id' => 23, 'name' => 'Roberto Segura'];

		$object = new Object($data);

		$reflection = new \ReflectionClass($object);
		$dataProperty = $reflection->getProperty('data');
		$dataProperty->setAccessible(true);

		$this->assertEquals($data, $dataProperty->getValue($object));

		$object->clear();
		$this->assertEquals([], $dataProperty->getValue($object));
	}

	/**
	 * get returns null for non-existing property.
	 *
	 * @return  void
	 */
	public function testGetReturnsDefaultForMissigProperty()
	{
		$object = new Object(['testNull' => null, 'testEmpty' => '', 'testZero' => 0]);

		$this->assertSame(null, $object->get('unknown'));
		$this->assertSame('value', $object->get('unknown', 'value'));
		$this->assertSame('value', $object->get('testNull', 'value'));
		$this->assertSame('', $object->get('testEmpty'));
		$this->assertSame(0, $object->get('testZero'));
	}

	/**
	 * get returns set value.
	 *
	 * @return  void
	 */
	public function testGetReturnsCorrectValue()
	{
		$data = ['id' => 23, 'name' => 'Roberto Segura', 'age' => 40];
		$object = new Object($data);

		foreach ($data as $property => $value)
		{
			$this->assertSame($value, $object->get($property));
		}
	}

	/**
	 * has returns correct value.
	 *
	 * @return  void
	 */
	public function testHasReturnsCorrectValue()
	{
		$object = new Object;

		$this->assertFalse($object->has('id'));
		$this->assertFalse($object->has('age'));
		$this->assertFalse($object->has('name'));

		$object = new Object(['id' => 23, 'name' => 'Roberto Segura']);

		$this->assertTrue($object->has('id'));
		$this->assertFalse($object->has('age'));
		$this->assertTrue($object->has('name'));
	}

	/**
	 * setData sets correct data.
	 *
	 * @return  void
	 */
	public function testSetDataSetsCorrectData()
	{
		$object = new Object;

		$reflection = new \ReflectionClass($object);
		$dataProperty = $reflection->getProperty('data');
		$dataProperty->setAccessible(true);

		$this->assertEquals([], $dataProperty->getValue($object));

		$data = ['id' => 23, 'name' => 'Roberto Segura'];
		$object->setData($data);

		$this->assertEquals($data, $dataProperty->getValue($object));
	}

	/**
	 * properties returns correct object properties.
	 *
	 * @return  void
	 */
	public function testPropertiesReturnsCorrectProperties()
	{
		$object = new Object;
		$this->assertEquals([], $object->properties());

		$object = new Object(['id' => 23, 'name' => 'Roberto Segura']);
		$this->assertEquals(['id', 'name'], $object->properties());
	}

	/**
	 * assign sets the correct value.
	 *
	 * @return  void
	 */
	public function testAssignSetsCorrectValue()
	{
		$object = new Object(['id' => 23, 'name' => 'Roberto Segura']);

		$reflection = new \ReflectionClass($object);
		$dataProperty = $reflection->getProperty('data');
		$dataProperty->setAccessible(true);

		$this->assertEquals(23, $dataProperty->getValue($object)['id']);

		$object->assign('id', 35);

		$this->assertEquals(35, $dataProperty->getValue($object)['id']);

		$object->assign('foo', 'var');

		$this->assertEquals('var', $dataProperty->getValue($object)['foo']);
	}

	/**
	 * unassign unsets a set property.
	 *
	 * @return  void
	 */
	public function testUnassignRemovesProperty()
	{
		$object = new Object(['id' => 23, 'name' => 'Roberto Segura']);

		$reflection = new \ReflectionClass($object);
		$dataProperty = $reflection->getProperty('data');
		$dataProperty->setAccessible(true);

		$this->assertEquals(['id', 'name'], array_keys($dataProperty->getValue($object)));

		$object->unassign('id');

		$this->assertEquals(['name'], array_keys($dataProperty->getValue($object)));

		$object->unassign('name');

		$this->assertEquals([], array_keys($dataProperty->getValue($object)));
	}
}
