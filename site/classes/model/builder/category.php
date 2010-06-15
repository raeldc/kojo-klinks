<?php defined('SYSPATH') or die('404 Not Found.');

/**
* 
*/
class Model_Builder_Category extends Jelly_Builder
{
	public function __construct($model = NULL, $type = NULL)
	{
		parent::__construct($model, $type);
		$this->where('extension', '=', 'com_weblinks');
	}
	
	public function unique_key($value='')
	{
		if (is_numeric($value))
		{
			return 'id';
		}
		
		return 'alias';
	}
}
