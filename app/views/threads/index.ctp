<div class="threads index">
<h2><?php __('Threads');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('topic_id');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('body');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($threads as $thread):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $thread['Thread']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($thread['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $thread['Topic']['id'])); ?>
		</td>
		<td>
			<?php echo $thread['Thread']['user_id']; ?>
		</td>
		<td>
			<?php echo $thread['Thread']['body']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $thread['Thread']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $thread['Thread']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $thread['Thread']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $thread['Thread']['id'])); ?>
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
		<li><?php echo $html->link(__('New Thread', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Topics', true), array('controller' => 'topics', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Topic', true), array('controller' => 'topics', 'action' => 'add')); ?> </li>
	</ul>
</div>
