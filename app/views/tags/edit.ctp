<div class="tags form">
<?php echo $form->create('Tag');?>
	<fieldset>
 		<legend><?php __('Edit Tag');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('longname');
		echo $form->input('Record');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Tag.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Tag.id'))); ?></li>
		<li><?php echo $html->link(__('List Tags', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Records', true), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Record', true), array('controller' => 'records', 'action' => 'add')); ?> </li>
	</ul>
</div>
