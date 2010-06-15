<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if (empty($links)) : ?>
	<p> <?php echo JText::_('COM_WEBLINKS_NO_WEBLINKS'); ?></p>
<?php else : ?>

<form action="<?php echo JFilterOutput::ampReplace(JFactory::getURI()->toString()); ?>" method="post" name="adminForm">

	<table class="category">
	<tbody>
	<?php foreach ($links as $i => $link) : ?>
		<tr class="<?php echo $i % 2 ? 'odd' : 'even';?>">
			<td class="num">
				<?php echo $i + 1; ?>
			</td>
			<td class="title">
			<p>
				<?php if ($params->get('link_icons') <> -1) : ?>
					<?php echo JHTML::_('image','system/'.$params->get('link_icons', 'weblink.png'), JText::_('COM_WEBLINKS_LINK'), NULL, true);?>
				<?php endif; ?>
				<?php
					// Compute the correct link
					$menuclass = 'category'.$params->get('pageclass_sfx');
					$url = HTML::uri(
						Route::get('default')->uri(array(
							'action' => 'category',
							'category' => $link->parent->alias,
							'link' => $link->alias,
						))
					);
					$target = ($link->params->target) ? $link->params->target : $params->get('target');
					switch ($target)
					{
						case 1:
							// open in a new window
							echo '<a href="'. $url .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'.
								Text::escape($link->title) .'</a>';
							break;

						case 2:
							// open in a popup window
							echo "<a href=\"#\" onclick=\"javascript: window.open('". $url ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass\">".
								Text::escape($link->title) ."</a>\n";
							break;
						case 3:
							// TODO: open in a modal window
							JHtml::_('behavior.modal', 'a.modal'); ?>
							<a class="modal" title="<?php  echo Text::escape($link->title) ?> " href="<?php echo $url;?>"  rel="{handler: 'iframe', size: {x: 500, y: 506}}\"></a>
							<?php echo Text::escape($link->title). ' </a>' ;
							break;

						default:
							// open in parent window
							echo '<a href="'.  $url . '" class="'. $menuclass .'" rel="nofollow">'.
								Text::escape($link->title) . ' </a>';
							break;
					}
				?>
			</p>

			<?php if (($params->get('show_link_description')) AND ($link->description !='')): ?>
				<p>
				<?php echo nl2br($link->description); ?>
				</p>
			<?php endif; ?>
		</td>
		<?php if ($params->get('show_link_hits')) : ?>
		<td class="hits">
			<?php echo $link->hits; ?>
		</td>
		<?php endif; ?>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>
</form>
<?php endif; ?>