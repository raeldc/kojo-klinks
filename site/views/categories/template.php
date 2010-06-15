<?php defined('SYSPATH') or die('404 Not Found.'); ?>

<div class="categories-list<?php echo $params->get('pageclass_sfx');?>">
<?php if ($params->get('show_page_heading', 1)) : ?>
<h1>
	<?php echo Text::escape($params->get('page_heading', $page_heading)); ?>
</h1>
<?php endif; ?>

<?php if ($params->get('show_base_description')) : ?>
		<?php if($params->get('categories_description')) : ?>
			<?php echo  JHtml::_('content.prepare',$params->get('categories_description')); ?>
		<?php endif; ?>
<?php endif; ?>

<?php echo $items; ?>
</div>