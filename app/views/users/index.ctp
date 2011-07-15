<div class="breadcrumb">
	<? echo $crumb->getHtml('Home','reset'); ?>
</div>
<div class="searchBox" style="margin: 0 auto; text-align: center;">
	<h1>Find something. <font color="#666666">Anything.</font></h1>
	<p>
		<form action="/records/search" method="post">
		<input type="textbox" class="search-box" value="Search..." name="data[Record][q]" size="40" onClick="this.value=''"> <input type="submit" value="Go!" class="search-go">
		</form>
	</p>
</div>
<div class="user_index">
	<div class="menu">
		<h4>Menu</h4>
		<ul>
			<li><?=$html->link('Add Item','/records/add')?></li>
			<li><? echo $html->link('logout', '#', array('onclick' => 'FB.Connect.logout(function() { document.location = \'http://productthreads.com/users/logout/\'; }); return false;')); ?></li>
		</ul>
	</div>
	<div class="profile">
		<?
		echo "<p>Welcome, ".$user['User']['username']."!</p>";
		echo "<p><img src='".$user['User']['profile_image_url']."'></p>";
		echo "<p>Your role: ".$user['User']['role']."</p>";
		echo "<p>Account Type: ".$user['User']['type']."</p>";
		?>
	</div>
	<div style="clear: both;"></div>
	<div class="activities">
		<?
		if(isset($user_stats['forumActivity'])){
		?>
		<div class="activity rounded {5px}">
			<h3>Your Recent Forum Activity</h3>
			<ul>
			<?
			foreach(array_reverse($user_stats['forumActivity']) as $forum):
				$forums = explode("PISTOLPETE",$forum);
				echo "<li>".$html->link($forums[1],'/records/view/'.$forums[0])."</li>";
			endforeach;
			?>
			</ul>
		</div>
		<?
		}

		if(isset($user_stats['topicActivity'])){
		?>
		<div class="activity rounded {5px}">
			<h3>Your Recent Topic Activity</h3>
			<ul>
			<?
			foreach(array_reverse($user_stats['topicActivity']) as $topic):
				$topics = explode("PISTOLPETE",$topic);
				echo "<li>".$html->link($topics[1],'/topics/view/'.$topics[0])."</li>";
			endforeach;
			?>
			</ul>
		</div>
		<?
		}
		?>
		<div class="activity rounded {5px}">
			<h3>Recently Added Items</h3>
			<ul>
				<li><?=$html->link('Palm Pre','/records/view/5')?></li>
			</ul>
		</div>
		<div class="activity rounded {5px}">
			<h3>Recently Active Discussions</h3>
			<ul>
				<li><?=$html->link('For IPhone Fans! RT @Minervity: Difference of iPhone 3G and 3GS - http://bit.ly/SPJwO','/topics/view/1546')?></li>
			</ul>
		</div>
		<div style="clear: both; height: 10px;"></div>
		<div class="activity rounded {5px}" style="width: 358px;">
			<h3>What are your friends up to?</h3>
			<ul>
				<li><?=$html->link('estelle is looking at the iPhone 3GS','/records/view/2')?></li>
			</ul>
		</div>
		<div class="activity rounded {5px}" style="width: 358px;">
			<h3>What is hot right now?</h3>
			<ul>
				<li><?=$html->link('Inglorious Basterds apparently was a great movie!','/records/view/2')?></li>
			</ul>
		</div>
	</div>
</div>
<div style="clear: both;"></div>
<?
//debug($test);
?>