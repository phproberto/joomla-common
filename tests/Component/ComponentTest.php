<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Component;

use Joomla\Registry\Registry;
use Phproberto\Joomla\Tests\Component\Stubs\Component;

/**
 * Tests ComponentHelper class.
 *
 * @since  __DEPLOY_VERSION__
 */
class ComponentTest extends \TestCaseDatabase
{
	/**
	 * Test the cached
	 *
	 * @return  void
	 */
	public function testClearInstance()
	{
		$component = Component::getInstance('com_content');
		$this->assertEquals('Content', $component->getPrefix());

		$reflection = new \ReflectionClass($component);
		$prefix = $reflection->getProperty('prefix');
		$prefix->setAccessible(true);
		$prefix->setValue($component, 'Custom');

		$component2 = Component::getInstance('com_content');
		$this->assertEquals('Custom', $component2->getPrefix());
		Component::clearInstance('com_content');

		$component2 = Component::getInstance('com_content');
		$this->assertEquals('Content', $component2->getPrefix());
	}

	/**
	 * Test getExtension method.
	 *
	 * @return  void
	 */
	public function testGetExtension()
	{
		$component = Component::getInstance('com_content');
		$this->assertEquals(Component::databaseExtension(), $component->getExtension());

		$reflection = new \ReflectionClass($component);
		$extension = $reflection->getProperty('extension');
		$extension->setAccessible(true);

		$customExtension = new Registry(array('foo' => 'var', 'var' => 'foo'));

		$extension->setValue($component, $customExtension);
		$this->assertEquals($customExtension, $component->getExtension());
		$this->assertEquals(Component::databaseExtension(), $component->getExtension(true));
	}

	/**
	 * Test getParams method.
	 *
	 * @return  void
	 */
	public function testGetParams()
	{
		$component = Component::getInstance('com_content');
		$defaultParams = new Registry(Component::databaseExtension()->params);
		$this->assertEquals($defaultParams, $component->getParams());

		$reflection = new \ReflectionClass($component);
		$params = $reflection->getProperty('params');
		$params->setAccessible(true);

		$customParams = new Registry(array('foo' => 'var', 'var' => 'foo'));
		$params->setValue($component, $customParams);
		$this->assertEquals($customParams, $component->getParams());
		$this->assertEquals($defaultParams, $component->getParams(true));
	}

	/**
	 * Test the getInstance method.
	 *
	 * @return  void
	 */
	public function testGetInstance()
	{
		$component = Component::getInstance('com_content');
		$this->assertEquals('Content', $component->getPrefix());

		$component = Component::getInstance('COM_CONTENT');
		$this->assertEquals('Content', $component->getPrefix());

		$reflection = new \ReflectionClass($component);
		$prefix = $reflection->getProperty('prefix');
		$prefix->setAccessible(true);
		$prefix->setValue($component, 'Custom');

		$component2 = Component::getInstance('com_content');
		$this->assertEquals('Custom', $component2->getPrefix());

		$prefix->setValue($component, null);
		$this->assertEquals('Content', $component2->getPrefix());
	}

	/**
	 * Test getPrefix method.
	 *
	 * @return  void
	 */
	public function testGetPrefix()
	{
		$component = Component::getInstance('com_content');
		$this->assertEquals('Content', $component->getPrefix());

		$component = Component::getInstance('com_banners');
		$this->assertEquals('Banners', $component->getPrefix());

		$component = Component::getInstance();
		$this->assertEquals('Content', $component->getPrefix());
	}

	/**
	 * Test getTable method.
	 *
	 * @return  void
	 */
	public function testGetTable()
	{
		$component = Component::getInstance('com_categories');
		$table = $component->getTable('Category');
		$this->assertEquals('CategoriesTableCategory', get_class($table));

		$component = Component::getInstance('com_menus');
		$table = $component->getTable('Menu');
		$this->assertEquals('MenusTableMenu', get_class($table));
	}
}
