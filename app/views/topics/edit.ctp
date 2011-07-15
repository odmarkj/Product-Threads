<div class="topics form">
<?php echo $form->create('Topic');?>
	<fieldset>
 		<legend><?php __('Edit Topic');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('user_id');
		echo $form->input('record_id');
		echo $form->input('title');
		echo $form->input('body');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Topic.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Topic.id'))); ?></li>
		<li><?php echo $html->link(__('List Topics', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Records', true), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Record', true), array('controller' => 'records', 'action' => 'add')); ?> </li>
	</ul>
</div>
