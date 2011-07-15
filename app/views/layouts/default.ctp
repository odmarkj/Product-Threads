<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<?php echo $html->css('v1/style'); ?>
<?php echo $html->css('v1/frame'); ?>
<?
//Check if user is logged in
if($session->check('Auth.User.id') == true){
?>
<script src="/js/toolbar.js" type="text/javascript"></script>
<?
}
?>
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery-corners.js" type="text/javascript"></script>
<link href="/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="/facebox/facebox.js" type="text/javascript"></script> 
<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script>
<script type="text/javascript">
FB.init("149e58a8bc4ccc5b233c6911ad9ede64","/xd_receiver.htm");

jQuery(document).ready(function($) {
  $('a[rel*=facebox]').facebox()
})
</script>
<!-- Include external files and scripts here (See HTML helper for more info.) -->
<?php echo $scripts_for_layout ?>
</head>
<body>
<?
if ($session->check('Message.auth')){
	echo "<div class='message'>".$session->flash('auth')."</div>";
}
?>
<div id="header-container">
	<div id="header">
		<div id="logo">
			<span class="siteName"><a href="/">Thread.ly</a><? if(!empty($record_link)) echo " >> <a href='/".$record_link."'>".$record_name."</a>"; ?></span> What is happening now.
		</div>
		<div id="connect">
			<?
			//Check if user is logged in
			if($session->check('Auth.User.id') == true){
				echo "<a href='/users/'>My Home Page</a>";
			}else{
				echo "<a href='/users/login' rel='facebox'>Login</a>";
			}
			?>
		</div>
	</div>
	<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
<div id="container">
	<!--><div id="clear"></div>
	<div id="search" class="rounded {20px}">
		
	</div>-->
	<div id="clear"></div>
	<div id="theBody">
		<div id="content">
			<?php echo $content_for_layout ?>
		</div>
		<div id="clear"></div>
	</div>
</div>
<div id="footer">
	CODENAME ROSE
</div>
<div id="toolbar" style="display: none;">
	<div id="apps">
		<div id="app">
			Welcome, <a href="/users/"><?echo $session->read('Auth.User.username');?></a>!
		</div>
	</div>
	<div id="activity">
		<ul>
			<li><a href="javascript:toggleFactivity();">Recent Forum Activity</a></li>
		</ul>
	</div>
	<div id="fcontainer" style="display: none;">
		<div id="factivity">
			<span style="float: left; width: 80%;" class="fhead">Recent Forum Activity</span>
			<span style="text-align: right; float: right; width: 20%;" class="fhead"><a href="javascript:toggleFactivity();">[x]</a></span>
			<div style="clear: both; height: 3px; background-color: #000000;"></div>
			<ul>
				<?
				$factivity = $_COOKIE['CakeCookie']['forumActivity'];
				//var_dump($factivity);
				$activity = array_reverse(explode(",",$factivity));
				foreach($activity as $forum):
					$vals = explode("PISTOLPETE",$forum);
					$idvals = explode("|",$vals[0]);
					echo "<li><a href='/records/view/".$idvals[1]."'>".$vals[1]."</a></li>";
				endforeach;
				?>
			</ul>
		</div>
	</div>
</div>
<?
//Check if user is logged in
if($session->check('Auth.User.id') == true){
?>
<script type="text/javascript">
//Show toolbar
activateToolbar();
</script>
<?
}
?>
</body>
</html>