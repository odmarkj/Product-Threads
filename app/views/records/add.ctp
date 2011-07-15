<div class="records form">
<?php echo $form->create('Record');?>
	<fieldset>
 		<legend><?php __('Add Record');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('Tag');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Records', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Topics', true), array('controller' => 'topics', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Topic', true), array('controller' => 'topics', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Tag', true), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
