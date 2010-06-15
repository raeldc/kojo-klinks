<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="weblink-category<?php echo $params->get('pageclass_sfx');?>">
<?php if ($params->get('show_page_heading', 1)) : ?>
<h1>
	<?php echo Text::escape($params->get('page_heading', $page_heading)); ?>
</h1>
<?php endif; ?>

<?php if($params->get('show_category_title', 1) && $params->get('page_subheading')) : ?>
<h2>
	<?php echo $this->escape($params->get('page_subheading', $page_subheading)); ?>
</h2>
<?php endif; ?>
<?php if ($params->get('show_description', 1) || $params->def('show_description_image', 1)) : ?>
	<div class="category_desc">
	<?php if ($params->get('show_description_image') && $category->params->image) : ?>
		<img src="<?php echo $category->params->image; ?>"/>
	<?php endif; ?>
	<?php if ($params->get('show_description') && $category->description) : ?>
		<?php echo JHtml::_('content.prepare', $category->description); ?>
	<?php endif; ?>
	<div class="clr"></div>
	</div>
<?php endif; ?>

<?php if ($category->links->count()): ?>
	<?php 
		echo View::factory('category/links')
				->set('links', $category->links)
				->render(); 
	?>
<?php endif ?>

<?php if ($category->children->count()): ?>
	<div class="cat-children">
	<h3><?php echo JText::_('JGLOBAL_SUBCATEGORIES') ; ?></h3>
	
	<?php  echo $subcategories;?>
	</div>
<?php endif ?>
</div>
