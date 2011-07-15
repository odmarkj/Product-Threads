<?
$this->pageTitle = $record[0]['Record']['name'].' Threads';

if(isset($_COOKIE['tab']))
	$clicked = $_COOKIE['tab'];
else
	$clicked = "first";
?>
<script type="text/javascript">
function setCookie(c_name,value,expiredays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+
	((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

var clicked = "";
var clickedDiv = clicked+"Div";
function selectLink(target){
	var targetDiv = target+"Div";
	document.getElementById(target).style.color = '#ffffff';
	document.getElementById(target).style.backgroundColor = '#5f789e';
	document.getElementById(targetDiv).style.display = "block";
	
	if(clicked.length != 0){
		document.getElementById(clicked).style.color = '#333333';
		document.getElementById(clicked).style.backgroundColor = '#cccccc';
		document.getElementById(clickedDiv).style.display = "none";
	}
	
	clicked = target;
	clickedDiv = targetDiv;
	setCookie("tab",target,"1");
}
</script>
<?
$reverse = $record[0]['Topic'];
?>
<div class="breadcrumb">
	<? 
	//echo $crumb->getHtml($record[0]['Record']['name']);
	echo $breadcrumb;
	?>
</div>
<div class="searchBox" style="margin: 0 auto; text-align: center; padding: 0px 0px 20px 0px;">
		<form action="/records/search" method="post">
		<input type="textbox" class="search-box" value="Search..." name="data[Record][q]" size="30" onClick="this.value=''"> <input type="submit" value="Go!" class="search-go">
		</form>
</div>
<div class="records custom-view">
	<div class="userRecordContent">
		<?php echo $record[0]['Record']['description']; ?>
		<div style="clear: both;"></div>
		<p class="tags"><b>Tags: </b>
			<?
			$i = 0;
			foreach ($record[0]['Tag'] as $tag):
				if($i != 0)
					echo ", ";
				echo $tag['longname'];
				$i++;
			endforeach;
			?></small>
		</p>
	</div>
</div>
<div style="clear: both;"></div>
<a name="focus"></a>
<div class="actions">
	<span style="float: left; width: 50%; text-align: left;"><a href="/topics/add/<?=$record[0]['Record']['id']?>"><img src="/img/newtopic.gif" border="0"></a></span>
	<span style="float: right; width: 50%; text-align: right;"><a href="/records/rss/<?=$record[0]['Record']['id']?>" target="_blank"><img src="/img/icon_rss_35X35.gif" border="0" height="25px"></a> </span>
</div>
<div style="clear: both; height: 10px;"></div>
<span style="float: left; width: 50%; text-align: left; margin-top: 10px;">
<ul class="topicNav">
	<li><a href="#focus" id="first" onClick="selectLink('first')">Active Discussions</a></li>
	<li><a href="#focus" id="second" onClick="selectLink('second')">Real-Time Topics</a></li>
	<li><a href="#focus" id="third" onClick="selectLink('third')">Most Popular</a></li>
	<li><a href="#focus" id="fourth" onClick="selectLink('fourth')">Trending Topics</a></li>
</ul>
</span>
	<span style="float: left; width: 50%; text-align: right;"><form action="/topics/search" method="post">
	<input type="hidden" name="data[Topic][record_id]" value="<?=$record[0]['Record']['id']?>">
<input type="textbox" value="Search this forum..." name="data[Topic][q]" size="20" onClick="this.value=''" class="search-box"> <input type="submit" value="Go!" class="search-go">
</form>
</span>
<div style="clear: both;"></div>
<div class="related">
	<ul class="topiclist">
		<li class="header">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="60%" class="name">
						<?php echo $record[0]['Record']['name']; ?> Threads
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
		<?php if (!empty($record[0]['Topic'])):?>
		<ul class="topiclist">
			<?
			foreach ($record[0]['Announcement'] as $announce):
				$dividerTrigger = "true";
			?>
			<li class="row">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="3%" align="center" style="background-color: #c1d2dc;">
						</td>
						<td width="57%" class="name">
							Announcement: <? echo $html->link($announce['title'], $announce['url'], array('class'=>'subject','target'=>'_blank')); ?><br>by <?=$html->link($announce['User']['username'], "/users/view/".$announce['User']['id'], array('class'=>'author'))?> >> <?=date("D M j, Y g:i a", strtotime($announce['created']))?>
						</td>
						<td width="10%" class="threads" style="background-color: #c1d2dc;">
							
						</td>
						<td width="10%" class="views">
							
						</td>
						<td width="20%" class="lastpost" style="background-color: #c1d2dc;">
							
						</td>
					</tr>
				</table>
			</li>
			<?
			endforeach;
			?>
		<div id="firstDiv" style="display: none;">
		<?php
			$i = 0;
			foreach ($active as $topic):
				if($i==0 && $dividerTrigger == "true")
					echo '<li class="row" style="border-top: 5px solid #5f789e;">';
				else
					echo '<li class="row">';
			?>
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td width="3%" align="center" style="background-color: #c1d2dc;">
								<img src="/img/<?=$topic['Topic']['type']?>.png">
							</td>
							<td width="57%" class="name">
								<?
								$theTitle = $topic['Topic']['title'];
								$len = strlen($theTitle);
								if($len >= 100)
									$title = substr($theTitle,0,100)."... ";
								else
									$title = $theTitle;
								echo $html->link($title, array('controller' => 'topics', 'action' => 'view', $topic['Topic']['id']), array('class'=>'subject')); ?><br>by <?=$html->link($topic['User']['username'], "/users/view/".$topic['Topic']['user_id'], array('class'=>'author'))?> >> <?=date("D M j, Y g:i a", strtotime($topic['Topic']['published']))?>
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
		<?php
		$i++; 
		endforeach; 
		?>
		</div>
		<div id="secondDiv" style="display: none;">
			<?php
				$i = 0;
				foreach ($record[0]['Topic'] as $topic):
					if($i==0 && $dividerTrigger == "true")
						echo '<li class="row" style="border-top: 5px solid #5f789e;">';
					else
						echo '<li class="row">';
				?>
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td width="3%" align="center" style="background-color: #c1d2dc;">
									<img src="/img/<?=$topic['type']?>.png">
								</td>
								<td width="57%" class="name">
									<?
									$theTitle = $topic['title'];
									$len = strlen($theTitle);
									if($len >= 100)
										$title = substr($theTitle,0,100)."... ";
									else
										$title = $theTitle;
									echo $html->link($title, array('controller' => 'topics', 'action' => 'view', $topic['id']), array('class'=>'subject')); ?><br>by <?=$html->link($topic['User']['username'], "/users/view/".$topic['user_id'], array('class'=>'author'))?> >> <?=date("D M j, Y g:i a", strtotime($topic['published']))?>
								</td>
								<td width="10%" class="threads" style="background-color: #c1d2dc;">
									<?=$topic['replies']?>
								</td>
								<td width="10%" class="views">
									<?=$topic['views']?>
								</td>
								<td width="20%" class="lastpost" style="background-color: #c1d2dc;">
									<?
									if(!empty($topic['last_poster_id'])){
									?>
									<?=date("D M j, Y g:i a", strtotime($topic['last_post_time']))?><br>by <?=$html->link($topic['last_poster_name'], "/users/view/".$topic['last_poster_id'], array('class'=>'author'))?> <?=$html->link('>>', "/topics/view/".$topic['id'])?>
									<?
									}else{
										echo "NA";
									}
									?>
								</td>
							</tr>
						</table>
					</li>
			<?php
			$i++; 
			endforeach; 
			?>
		</div>
		<div id="thirdDiv" style="display: none;">
			<?php
				$i = 0;
				foreach ($popular as $topic):
					if($i==0 && $dividerTrigger == "true")
						echo '<li class="row" style="border-top: 5px solid #336699;">';
					else
						echo '<li class="row">';
				?>
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td width="3%" align="center" style="background-color: #c1d2dc;">
									<img src="/img/<?=$topic['Topic']['type']?>.png">
								</td>
								<td width="57%" class="name">
									<?
									$theTitle = $topic['Topic']['title'];
									$len = strlen($theTitle);
									if($len >= 100)
										$title = substr($theTitle,0,100)."... ";
									else
										$title = $theTitle;
									echo $html->link($title, array('controller' => 'topics', 'action' => 'view', $topic['Topic']['id']), array('class'=>'subject')); ?><br>by <?=$html->link($topic['User']['username'], "/users/view/".$topic['Topic']['user_id'], array('class'=>'author'))?> >> <?=date("D M j, Y g:i a", strtotime($topic['Topic']['published']))?>
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
			<?php
			$i++; 
			endforeach; 
			?>
		</div>
		<div id="fourthDiv" style="display: none;">
			<li class="row" style="border-top: 5px solid #336699;">
			<div style="padding: 10px;">
				<h3 style="margin: 0px;">Trending Topics</h3>
				<ol>
					<li>iPhone's Broke</li>
					<li>ATT</li>
					<li>MMS</li>
					<li>video recording</li>
					<li>unlocked</li>
					<li>Google Voice</li>
					<li>NES Emulator</li>
					<li>Review</li>
					<li>battery life</li>
					<li>apps</li>
				</ol>
			</div>
			</li>
		</div>
		</ul>
	<?php endif; ?>
	</div>
</div>
<div class="actions">
	<p><a href="/topics/add/<?=$record[0]['Record']['id']?>"><img src="/img/newtopic.gif" border="0"></a></p>
</div>
<script type="text/javascript">
selectLink("<?=$clicked?>");
</script>
<?
//debug($thistest);
?>