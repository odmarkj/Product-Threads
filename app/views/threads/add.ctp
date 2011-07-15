<div class="breadcrumb">
	<? echo $crumb->getHtml('Post Thread'); ?>
</div>
<div class="related">
	<ul class="topiclist">
		<li class="header">
			<span style="width: 50%; float: left;">Reply To Thread</span>
			<span style="width: 50%; float: right; text-align: right;">Thread: <?=$topic['Topic']['title']?></span>
		</li>
	</ul>
	<div style="clear: both;"></div>
	<div class="inner">
		<ul class="topiclist">
			<li class="row">
				<div class="threads">
					<div class="container">
						<?php echo $form->create('Thread',array('action'=>'add/'.$topic_id));?>
							<?=$form->hidden('topic_id',array("value"=>$topic_id));?>
							<?=$form->hidden('user_id',array("value"=>$user_profile['Auth']['User']['id']));?>
							<div class="actions">
								Action Icons
							</div>
							<div class="inputBox">
								<span style="width: 70%; float: left; text-align: left;"><textarea name="data[Thread][body]" cols="65" rows="13" style="padding: 5px;"></textarea></span>
								<span style="width: 29%; float: right; text-align: left; border: 1px solid #666666; background-color: #c0e6f2;">
									<p>Smilies</p>
									<p></p>
								</span>
							</div>
							<p style="clear: both; text-align: center; padding: 10px 0px 0px 0px;"><input type="submit" value="Post Reply"></p>
							<div style="clear: both"></div>
						<?php echo $form->end();?>
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>
<?
//debug($topic);
?>