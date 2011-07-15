<div class="public-user">
	<div class="details">
		<h1><?=$user['User']['username']?>'s Profile</h1>
		<p><img src="<?=$user['User']['profile_image_url']?>"></p>
		<p>User Type: <?=$user['User']['type']?></p>
		<p>User Role: <?=$user['User']['role']?></p>
		<?
		if(!empty($user['User']['fbook_profile_dump'])):
			$fbook = json_decode($user['User']['fbook_profile_dump']);
		?>
		<p style="padding: 5px 0px 5px 0px;"><b>About Me:</b> <?=$fbook->about_me?></p>
		<p style="padding: 5px 0px 5px 0px;"><b>Movies:</b> <?=$fbook->movies?></p>
		<p style="padding: 5px 0px 5px 0px;"><b>Music:</b> <?=$fbook->music?></p>
		<p style="padding: 5px 0px 5px 0px;"><b>Activities:</b> <?=$fbook->activities?></p>
		<p style="padding: 5px 0px 5px 0px;"><b>TV:</b> <?=$fbook->tv?></p>
		<p style="padding: 5px 0px 5px 0px;"><b>Books:</b> <?=$fbook->books?></p>
		<p style="padding: 5px 0px 5px 0px;"><b>Interests:</b> <?=$fbook->interests?></p>
		<p style="padding: 5px 0px 5px 0px;"><b>Quotes:</b> <?=$fbook->quotes?></p>
		<p style="padding: 5px 0px 5px 0px;"><b>Birthdate:</b> <?=$fbook->birthday_date?></p>
		<p style="padding: 5px 0px 5px 0px;"><b>Website(s):</b> <?=$fbook->website?></p>
		<?
		endif;
		?>
	</div>
</div>
<?
//debug($fbook);
?>