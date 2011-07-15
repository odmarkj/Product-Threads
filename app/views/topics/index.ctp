<div class="topics index">
<h2><?php __('Topics');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('record_id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('body');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($topics as $topic):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $topic['Topic']['id']; ?>
		</td>
		<td>
			<?php echo $topic['Topic']['user_id']; ?>
		</td>
		<td>
			<?php echo $html->link($topic['Record']['name'], array('controller' => 'records', 'action' => 'view', $topic['Record']['id'])); ?>
		</td>
		<td>
			<?php echo $topic['Topic']['title']; ?>
		</td>
		<td style="text-align: left;">
			<?php echo nl2br($topic['Topic']['body']); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $topic['Topic']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $topic['Topic']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $topic['Topic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $topic['Topic']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Topic', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Records', true), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Record', true), array('controller' => 'records', 'action' => 'add')); ?> </li>
	</ul>
</div>
