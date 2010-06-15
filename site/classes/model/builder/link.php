<?php defined('SYSPATH') or die('404 Not Found.');

/**
* 
*/
class Model_Builder_Link extends Jelly_Builder
{
	public function unique_key($value='')
	{
		if (is_numeric($value))
		{
			return 'id';
		}
		
		return 'alias';
	}
}
