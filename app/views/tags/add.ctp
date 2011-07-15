<div class="tags form">
<?php echo $form->create('Tag');?>
	<fieldset>
 		<legend><?php __('Add Tag');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('longname');
		echo $form->input('Record');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Tags', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Records', true), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Record', true), array('controller' => 'records', 'action' => 'add')); ?> </li>
	</ul>
</div>
