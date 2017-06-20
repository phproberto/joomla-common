<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Traits;

use Phproberto\Joomla\Tests\Traits\Stubs\ClassWithLayoutData;

/**
 * Tests for HasLayoutDataTest trait.
 *
 * @since  __DEPLOY_VERSION__
 */
class HasLayoutDataTest extends \TestCase
{
	/**
	 * Test getLayoutData method.
	 *
	 * @return  void
	 */
	public function testCachedLayoutData()
	{
		$class = new ClassWithLayoutData;

		$this->assertEquals(ClassWithLayoutData::defaultLayoutData(), $class->getData());

		$reflection = new \ReflectionClass($class);
		$layoutData = $reflection->getProperty('layoutData');
		$layoutData->setAccessible(true);

		$modifiedData = $layoutData->getValue($class);
		$modifiedData[get_class($class)]['my-property'] = 'my-value';

		$layoutData->setValue($class, $modifiedData);
		$this->assertEquals($modifiedData[get_class($class)], $class->getData());
		$this->assertNotEquals(ClassWithLayoutData::defaultLayoutData(), $class->getData());
		$this->assertEquals(ClassWithLayoutData::defaultLayoutData(), $class->getData(true));
	}
}
