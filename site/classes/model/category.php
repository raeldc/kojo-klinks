<?php defined('SYSPATH') or die('404 Not Found.');

/**
* 
*/
class ComKLinks_Model_Category extends Jelly_Model
{
	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'title' => new Field_String,
				'alias' => new Field_Slug,
				'description' => new Field_Text,
				'params' => new Field_JSON,
				'parent' => new Field_HasOne(array(
					'foreign' => 'category.id'
				)),
				'children' => new Field_HasMany(array(
					'foreign' => 'category.parent_id'
				)),
				'links' => new Field_HasMany(array(
					'foreign' => 'link.catid'
				)),
				'level' => new Field_Integer,
				'metadata' => new Field_JSON,
				'published' => new Field_Boolean
			));
	}
	
	
}