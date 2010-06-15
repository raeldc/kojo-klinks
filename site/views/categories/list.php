<?php defined('SYSPATH') or die('404 Not Found.');?>

<?php
	$class = ' class="first"';	
	if ($categories->count() > 0) :
		$i = 0;
	?>
<ul>
	<?php foreach($categories as $item) : 
			$i++;
			?>
			<?php
			if($params->get('show_empty_categories') || $item->children->count() || $item->links->count()) :
			if($i >= $categories->count())
			{
				$class = ' class="last"';
			}
			?>
			<li<?php echo $class; ?>>
			<?php $class = ''; ?>
				<span class="jitem-title">
					<?php $title =Text::escape($item->title); ?>
					<?php echo Route::anchor('default', array(
						'action' => 'category',
						'category' => $item->alias,
					), Text::escape($item->title)); ?>
				</span>
				<?php if ($item->description) : ?>
					<div class="category-desc">
						<?php echo JHtml::_('content.prepare', $item->description); ?>
					</div>
				<?php endif; ?>
				<?php if ($params->get('show_numbers') == 1) :?>
					<dl class="weblink-count"><dt>
						<?php echo JText::_('COM_WEBLINKS_NUM'); ?></dt>
						<dd><?php echo $item->children->count() + $item->links->count(); ?></dd>
					</dl>
				<?php endif; ?>

				<?php if($limit == -1 OR ($level < $limit AND ($item->children->count() OR $item->links->count()))) :
					echo View::factory('categories/list')
							->set('categories', $item->children)
							->set('limit', $limit)
							->set('level', $level + 1);
				endif; ?>

			</li>
			<?php endif; ?>
	<?php endforeach; ?>
</ul>
<?php endif; ?>