<div class="breadcrumb">
	<? 
	//echo $crumb->getHtml($topic[0]['Topic']['title']); 
	echo $breadcrumb;
	?>
</div>
<h1><?=$topic[0]['Topic']['title']?></h1>
<a href="/threads/add/<?=$topic[0]['Topic']['id']?>"><img src="/img/postreply.gif" border="0"></a>
<div class="topics">
	<div class="topicActions">
		<ul>
			<li><a href="">Rating</a></li><li><a href="">Search This Thread</a></li><li><a href="">Thread Tools</a></li>
		</ul>
	</div>
	<div style="clear: both;"></div>
	<div class="topics view first">
	<div class="threadDetails">
		<?php echo $topic[0]['Topic']['created']; ?>
	</div>
	<div style="clear: both;"></div>
	<span style="width: 15%; float: left;">
		<div class="userDetails">
			<p class="theAuthor"><?php echo $html->link($topic[0]['User']['username'], "/users/view/".$topic[0]['User']['id']); ?></p>
			<p><img src="<?=$topic[0]['User']['profile_image_url']?>"></p>
			<p>User Role: <?=$topic[0]['User']['role']?></p>
			<p>User Type: <?=$topic[0]['User']['type']?></p>
		</div>
	</span>
	<span style="width: 85%; float: left;">
	<p class="threadTitle"><?php echo $topic[0]['Topic']['title']; ?></p>
	<p class="threadBody"><?php echo make_clickable($topic[0]['Topic']['body']); ?></p>
	</span>
	<div style="clear: both;"></div>
</div>
<? foreach($threads as $thread): ?>
	<div class="topics view second">
		<div class="threadDetails">
			<?php echo $thread['Thread']['created']; ?>
		</div>
		<div style="clear: both;"></div>
		<span style="width: 15%; float: left;">
			<div class="userDetails">
				<p class="theAuthor"><?php echo $html->link($thread['User']['username'], "/users/view/".$thread['User']['id']); ?></p>
				<p><img src="<?=$thread['User']['profile_image_url']?>"></p>
				<p>User Role: <?=$thread['User']['role']?></p>
				<p>User Type: <?=$thread['User']['type']?></p>
			</div>
		</span>
		<span style="width: 85%; float: left;">
		<p class="threadTitle">RE: <?php echo $topic[0]['Topic']['title']; ?></p>
		<p class="threadBody"><? echo make_clickable($thread['Thread']['body'])?></p>
		</span>
		<div style="clear: both;"></div>
	</div>
<? endforeach; ?>
	<a href="/threads/add/<?=$topic[0]['Topic']['id']?>"><img src="/img/postreply.gif" border="0"></a>
</div>
<?
/*
?>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Topic', true), array('action' => 'edit', $topic['Topic']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Topic', true), array('action' => 'delete', $topic['Topic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $topic['Topic']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Topics', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Topic', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Records', true), array('controller' => 'records', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Record', true), array('controller' => 'records', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?
*/

function make_clickable($text)
{
    $ret = ' ' . $text;
    $ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" class=\"defaultB\" target=\"_blank\">\\2</a>'", $ret);
    $ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" class=\"defaultB\" target=\"_blank\">\\2</a>'", $ret);
    $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\" class=\"default\">\\2@\\3</a>", $ret);
    $ret = substr($ret, 1);
    return($ret);
}
function findHash($text){
	$tweet = preg_replace("(#([a-zA-Z0-9]+))", "<a href=\"search.php?target_term=\\1\" class=\"default\">\\0</a>", $text);
	return $tweet;
}
function findKey($text){
	$tweet = preg_replace("(@([a-zA-Z0-9]+))", "<a href=\"http://www.twitter.com/\\1\" class=\"default\">\\0</a>", $text);
	return $tweet;
}

//debug($topic);
?>