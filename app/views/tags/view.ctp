<div class="tags view">
<h2><?php  __('Tag');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tag['Tag']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tag['Tag']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Longname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tag['Tag']['longname']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Tag', true), array('action' => 'edit', $tag['Tag']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Tag', true), array('action' => 'delete', $tag['Tag']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tag['Tag']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Tags', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Tag', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Records', true), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Record', true), array('controller' => 'records', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Records');?></h3>
	<?php if (!empty($tag['Record'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tag['Record'] as $record):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $record['id'];?></td>
			<td><?php echo $record['name'];?></td>
			<td><?php echo $record['description'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'records', 'action' => 'view', $record['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'records', 'action' => 'edit', $record['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'records', 'action' => 'delete', $record['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $record['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Record', true), array('controller' => 'records', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
