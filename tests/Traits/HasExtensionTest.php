<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Traits;

use Phproberto\Joomla\Tests\Traits\Stubs\ClassWithExtension;
use Phproberto\Joomla\Tests\Traits\Stubs\DatabaseExtension;

/**
 * Tests for HasExtension trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class HasExtensionTest extends \TestCase
{
	/**
	 * Test getExtension method.
	 *
	 * @return  void
	 */
	public function testGetExtension()
	{
		$class = new ClassWithExtension;

		$this->assertEquals(ClassWithExtension::defaultExtension(), $class->getExtension());

		$modified = $class->getExtension();
		$modified->name = 'Modified name';

		$this->assertEquals(ClassWithExtension::defaultExtension(), $class->getExtension());
		$this->assertNotEquals(ClassWithExtension::defaultExtension(), $modified);
	}

	/**
	 * Test getExtensionProperty method.
	 *
	 * @return  void
	 */
	public function testGetExtensionProperty()
	{
		$class = new ClassWithExtension;
		$this->assertEquals(ClassWithExtension::defaultExtension()->name, $class->getExtensionProperty('name'));
		$this->assertEquals(null, $class->getExtensionProperty('custom-property'));
		$this->assertEquals('default-value', $class->getExtensionProperty('custom-property', 'default-value'));
	}

	/**
	 * Test that loadExtension is only triggered once.
	 *
	 * @return  void
	 */
	public function testExtensionIsCached()
	{
		$class = new ClassWithExtension;

		$this->assertEquals(ClassWithExtension::defaultExtension(), $class->getExtension());

		$modifiedData = $class->getExtension();
		$modifiedData->name = 'Another name';

		$reflection = new \ReflectionClass($class);
		$extension = $reflection->getProperty('extension');
		$extension->setAccessible(true);
		$extension->setValue($class, $modifiedData);

		$this->assertEquals($modifiedData, $class->getExtension());
		$this->assertEquals(ClassWithExtension::defaultExtension(), $class->getExtension(true));
	}
}
