<div class="user_login" style="width: 500px; height: 300px;">
	<h1>Two Ways To Login</h1>
	<div class="our">
		<h2>Our Site</h2>
		<p>
		<?
		echo $form->create('User', array('action'=>'login'));
		echo $form->input('username');
		echo $form->input('password', array('type'=>'password'));
		echo $form->end('Login');
		?>
		</p>
	</div>
	<div class="or">
		or
	</div>
	<div class="facebook">
		<h2>Facebook</h2>
		<?
    if(!empty($user)):
        if($user['User']['fbid'] > 0):
            echo $html->link('logout', '#', array('onclick' => 'FB.Connect.logout(function() { document.location = \'http://productthreads.com/users/logout/\'; }); return false;'));
        else:
            echo $html->link('logout', array('controller' => 'users', 'action' => 'logout'));
        endif;
    else:
        echo '<fb:login-button onlogin="window.location.reload();"></fb:login-button>';
    endif;
		?>
	</div>
</div>