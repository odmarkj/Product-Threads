<div class="threads form">
<?php echo $form->create('Thread');?>
	<fieldset>
 		<legend><?php __('Edit Thread');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('topic_id');
		echo $form->input('user_id');
		echo $form->input('body');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Thread.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Thread.id'))); ?></li>
		<li><?php echo $html->link(__('List Threads', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Topics', true), array('controller' => 'topics', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Topic', true), array('controller' => 'topics', 'action' => 'add')); ?> </li>
	</ul>
</div>
