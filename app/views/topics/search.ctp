<h1>Topics</h1>
<?php 
    echo $form->create("Topic",array('action' => 'search'));
    echo $form->input("q", array('label' => 'Search for'));
		echo $form->hidden('record_id',array("value"=>$record_id));
    echo $form->end("Search");
?>
<div class="related">
	<ul class="topiclist">
		<li class="header">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="60%" class="name">
						Threads
					</td>
					<td width="10%" class="threads">
						Replies
					</td>
					<td width="10%" class="views">
						Views
					</td>
					<td width="20%" class="lastpost">
						Last Post
					</td>
				</tr>
			</table>
		</li>
	</ul>
	<div class="inner">
		<ul class="topiclist">
			<?
			foreach ($results as $topic):
			?>
			<li class="row">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="3%" align="center" style="background-color: #c1d2dc;">
						</td>
						<td width="57%" class="name">
							<?php echo $html->link($topic['Topic']['title'],'/topics/view/'.$topic['Topic']['id'],array('class'=>'subject'));?><br>by <?=$html->link($topic['Topic']['User']['username'], "/users/view/".$topic['Topic']['User']['id'], array('class'=>'author'))?> >> <?=date("D M j, Y g:i a", strtotime($topic['Topic']['created']))?>
						</td>
						<td width="10%" class="threads" style="background-color: #c1d2dc;">
							<?=$topic['Topic']['replies']?>
						</td>
						<td width="10%" class="views">
							<?=$topic['Topic']['views']?>
						</td>
						<td width="20%" class="lastpost" style="background-color: #c1d2dc;">
							<?
							if(!empty($topic['Topic']['last_poster_id'])){
							?>
							<?=date("D M j, Y g:i a", strtotime($topic['Topic']['last_post_time']))?><br>by <?=$html->link($topic['Topic']['last_poster_name'], "/users/view/".$topic['Topic']['last_poster_id'], array('class'=>'author'))?> <?=$html->link('>>', "/topics/view/".$topic['Topic']['id'])?>
							<?
							}else{
								echo "NA";
							}
							?>
						</td>
					</tr>
				</table>
			</li>
			<?
			endforeach;
			?>
		</ul>
	</div>
</div>
<?
//debug($results);
?>