<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Links extends Controller {

	public function action_categories()
	{
		$categories = Jelly::select('category');
		
		/*
		 * If the route is something like this: categories/alias-of-category/2, 
		 *	 then we know that we're accessing the children of "alias-of-category" but display is limited to 2 levels only
		*/
		$category = $this->request->param('category', NULL);
		$category = Jelly::select('category', $category);
		$limit = $this->request->param('limit', $this->params->get('maxLevel', -1));
		$internal = FALSE;
		
		if ($category->loaded()) 
		{
			// Get the children of the category
			$categories->where('parent_id', '=', $category->id);
			
			// If a category is passed, I think this method is being accessed internally through HMVC
			$internal = TRUE;
		}else{
			// Just get all the 1st Level Categories
			$categories->where('level', '=', 1);
		}

		// Set the result in the View
		$items = View::factory('categories/list')
				->set('categories', $categories->execute())
				->set('limit', $limit)
				->set('level', 1)
				->render();
				
		// If this is an internal call, then we don't need to display the template which displays the headings
		if ($internal) 
		{
			$this->request->response = $items;
			return;
		}
				
		// Combine the 2 views, this view loads the Title and Description, then inserts the previous view "items" above
		$this->request->response = View::factory('categories/template')
			->set('items', $items)
			/*
			 * $this->params is the merged parameters of the component and the menu. 
			 * 		The controller accesses it as $this->params, the view accesses it as $params
			*/
			->set('page_heading', $this->params->get('page_title'))
			->render();
	}
	
	public function action_category()
	{
		/*
		 * If a link is being accessed, redirect to the link's URL
		 * 		The route is something like this to access this method:
		 *			eg: category/alias-of-the-category/alias-of-link
		 *	 	This won't work:
		 *			eg: category/alias-of-link
		 *		But we can always change the behavior depending on how the Route was configured
		*/
		if ($link = $this->request->param('link', NULL)) 
		{
			$link = Jelly::select('link', $link);
			
			if ($link->loaded()) 
			{
				$link->hits = $link->hits + 1;
				$link->save();
				
				$this->request->redirect($link->url);
				return;
			}
		}
		
		// Get the category from the database
		$category = Jelly::select('category', $this->request->param('category', NULL));
		
		// Make sure the category exists
		if ($category->loaded()) 
		{	
			$subcategories = '';
			
			// Check if the category has children
			if ($category->children->count()) 
			{
				// The Route we're passing in the Request::factory is trying to get the children of the current category
				$route = Route::get('categories')->uri(array(
						'category' => $category->alias,
						'limit' => 1,
					));
				
				/*
				 * Example HMVC Call
				 * 		One of the greatest features of Kohana is HMVC
				 *		I can reuse a controller method and get its output!
				 */
				$subcategories = Request::factory($route)->execute()->response;
			}
			
			$this->request->response = View::factory('category/template')
				->set('category', $category)
				->set('subcategories', $subcategories)
				// Set the default headings
				->set('page_heading', $category->parent->title)
				->set('page_subheading', $category->title)
				->render();
		}else{
			JError::raiseError('404', 'Can&rsquo;t find category!');
			return false;
		}
	}

} // End Welcome
