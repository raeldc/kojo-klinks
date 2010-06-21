<?php defined('SYSPATH') or die('404 Not Found.');

/**
* 
*/
class ComKLinks_Model_Link extends Jelly_Model
{
	public static function initialize(Jelly_Meta $meta)
	{
		$meta->table('weblinks')
			->fields(array(
				'id' => new Field_Primary,
				'title' => new Field_String,
				'alias' => new Field_Slug,
				'url' => new Field_String,
				'description' => new Field_Text,
				'hits' => new Field_Integer,
				'parent' => new Field_BelongsTo(array(
					'foreign' => 'category.id',
					'column' => 'catid',
				)),
				'params' => new Field_JSON,
				'metadata' => new Field_JSON,
				'state' => new Field_Integer
			));
	}
}
