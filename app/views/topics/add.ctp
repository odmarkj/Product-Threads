<div class="topics form">
<?php echo $form->create('Topic',array('action'=>'add/'.$record_id));?>
	<fieldset>
 		<legend><?php __('Add Topic');?></legend>
	<?php
		echo $form->hidden('record_id',array("value"=>$record_id));
		echo $form->hidden('user_id',array("value"=>$user_profile['Auth']['User']['id']));
		echo $form->hidden('type',array("value"=>"onsite"));
		//echo $form->input('user_id');
		//echo $form->input('record_id');
		echo $form->input('title');
		echo $form->input('body');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Topics', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Records', true), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Record', true), array('controller' => 'records', 'action' => 'add')); ?> </li>
	</ul>
</div>
