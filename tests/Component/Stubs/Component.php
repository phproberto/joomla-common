<?php
/**
 * Joomla! common library.
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

namespace Phproberto\Joomla\Tests\Component\Stubs;

use Phproberto\Joomla\Entity\Entity;

use Phproberto\Joomla\Component\Component as BaseComponent;

/**
 * Custom Component class to ease testability.
 *
 * @since  __DEPLOY_VERSION__
 */
class Component extends BaseComponent
{
	/**
	 * Function that replaces the load from DB logic.
	 *
	 * @return  \stdClass
	 */
	public static function databaseExtension()
	{
		return (object) array(
			'extension_id'     => 1337,
			'package_id'       => 0,
			'name'             => 'com_content',
			'type'             => 'component',
			'element'          => 'com_content',
			'folder'           => '',
			'client_id'        => 1,
			'enabled'          => 1,
			'access'           => 0,
			'manifest_cache'   => '{"name":"com_content","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2017 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"3.0.0","description":"COM_CONTENT_XML_DESCRIPTION","group":"","filename":"content"}',
			'params'           => '{"article_layout":"_:default","show_title":"1","link_titles":"1","show_intro":"1","show_category":"1","link_category":"1","show_parent_category":"0","link_parent_category":"0","show_author":"1","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"1","show_item_navigation":"1","show_vote":"0","show_readmore":"1","show_readmore_title":"1","readmore_limit":"100","show_icons":"1","show_print_icon":"1","show_email_icon":"1","show_hits":"1","show_noauth":"0","show_publishing_options":"1","show_article_options":"1","save_history":"1","history_limit":10,"show_urls_images_frontend":"0","show_urls_images_backend":"1","targeta":0,"targetb":0,"targetc":0,"float_intro":"left","float_fulltext":"left","category_layout":"_:blog","show_category_title":"0","show_description":"0","show_description_image":"0","maxLevel":"1","show_empty_categories":"0","show_no_articles":"1","show_subcat_desc":"1","show_cat_num_articles":"0","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_num_articles_cat":"1","num_leading_articles":"1","num_intro_articles":"4","num_columns":"2","num_links":"4","multi_column_order":"0","show_subcategory_content":"0","show_pagination_limit":"1","filter_field":"hide","show_headings":"1","list_show_date":"0","date_format":"","list_show_hits":"1","list_show_author":"1","orderby_pri":"order","orderby_sec":"rdate","order_date":"published","show_pagination":"2","show_pagination_results":"1","show_feed_link":"1","feed_summary":"0"}',
			'custom_data'      => '',
			'system_datas'     => '',
			'checked_out'      => 0,
			'checked_out_time' => '0000-00-00 00:00:00',
			'ordering'         => 0,
			'state'            => 0
		);
	}

	/**
	 * Get the active component. Mainly for testing purposes.
	 *
	 * @return  string
	 */
	protected static function getActiveComponent()
	{
		return 'com_content';
	}

	/**
	 * Load extension from db.
	 *
	 * @return  stdClass
	 */
	protected function loadExtension()
	{
		return self::databaseExtension();
	}
}
