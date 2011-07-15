<?
App::import('Vendor', 'facebook/facebook');

class AppController extends Controller
{
	var $components = array('Auth');
	var $uses = array('User');
	var $facebook;
	var $__fbApiKey = '149e58a8bc4ccc5b233c6911ad9ede64';
	var $__fbSecret = '247bd235c22b91717a98390909c743b1';
	var $home = "/";
	
	function __construct() {
		parent::__construct();

		// Prevent the 'Undefined index: facebook_config' notice from being thrown.
		$GLOBALS['facebook_config']['debug'] = NULL;

		// Create a Facebook client API object.
		$this->facebook = new Facebook($this->__fbApiKey, $this->__fbSecret);
	}

  function beforeFilter() {
		$this->Auth->allow('*');
		// Authentication settings
		$this->Auth->fields = array('username' => 'username', 'password' => 'password');
		$this->Auth->logoutRedirect = '/';

    //check to see if user is signed in with facebook
    $this->__checkFBStatus();

    //send all user info to the view
    $this->set('user', $this->Auth->user());
	}
	
	function getBreadcrumb($model = null, $recordAnchor = null, $recordId = null, $topicName = null){
		$bread = "<a href='".$this->getHomeLink()."'>Home</a>";

		if($model == "Record")
			$bread .= " >> ".$recordAnchor;
		elseif($model == "Topic")
			$bread .= " >> <a href='/records/view/".$recordId."'>".$recordAnchor."</a> >> ".$topicName;

		return $bread;
	}

	function getHomeLink(){
		if($this->Auth->user('id') != false)
			return "/users";
		else
			return $this->home;
	}

   private function __checkFBStatus(){
       //check to see if a user is not logged in, but a facebook user_id is set
       if(!$this->Auth->User() && $this->facebook->get_loggedin_user()):

           //see if this facebook id is in the User database; if not, create the user using their fbid hashed as their password
           $user_record =
               $this->User->find('first', array(
                   'conditions' => array('fbid' => $this->facebook->get_loggedin_user()),
                   'fields' => array('User.fbid', 'User.fbpassword', 'User.password'),
                   'contain' => array()
               ));

           //create new user
           if(empty($user_record)):
							$user_data = $this->facebook->get_user_data();
							$user_record['profile_image_url'] = $user_data[0]['pic'];
							$user_record['type'] = "facebook";
							$user_record['username'] = $user_data[0]['first_name']." ".$user_data[0]['last_name'];
              $user_record['fbid'] = $this->facebook->get_loggedin_user();
              $user_record['fbpassword'] = $this->__randomString();
              $user_record['password'] = $this->Auth->password($user_record['fbpassword']);
							$user_record['fbook_profile_dump'] = json_encode($user_data[0]);

              $this->User->create();
              $this->User->save($user_record);
           endif;

           //change the Auth fields
           $this->Auth->fields = array('username' => 'fbid', 'password' => 'password');

           //log in the user with facebook credentials
           $this->Auth->login($user_record);

       endif;
   }

   private function __randomString($minlength = 20, $maxlength = 20, $useupper = true, $usespecial = false, $usenumbers = true){
       $charset = "abcdefghijklmnopqrstuvwxyz";
       if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
       if ($usenumbers) $charset .= "0123456789";
       if ($usespecial) $charset .= "~@#$%^*()_+-={}|][";
       if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
       else $length = mt_rand ($minlength, $maxlength);
       $key = '';
       for ($i=0; $i<$length; $i++){
           $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
       }
       return $key;
   }

	function dumpCookie(){
		if($this->Auth->User('id') != false){
			$this->User->read(null, $this->Auth->user('id'));
	   	$this->User->set('site_cookie_dump', json_encode($_COOKIE));
	   	$this->User->save();
		}
	}

	function setUserActivity($key = null, $value = null, $expires = null){
		//How many entries to store in the cookies
		$maxRecords = 15;
		$split = "PISTOLPETE";
		
		if(!$key || !$value){
			//If both values are not sent, exit
			//exit();
		}else{
		
			//If $expires is empty, set it for a year
			if($expires == "")
				$expires = 31536000;
			
			$current = $this->Cookie->read($key);
		
			if(is_array($current)){
				$num = count($current);
				$find = $value[0].$split.$value[1];
				
				$doesExist = array_search($find, $current);
				if($doesExist === NULL || $doesExist === FALSE){
					$concat = $value[0].$split.$value[1];
					array_push($current, $concat);
					if($num >= $maxRecords){
						$last = array_shift($current);
					}

					//Set the new array
					$this->Cookie->write($key, $current, false, $expires);
				}
				return true;
			}else{
				$arr = array();
				$concat = $value[0].$split.$value[1];
				array_push($arr, $concat);
				$this->Cookie->write($key, $arr, false, $expires);
				return true;
			}
		}
		
	}
}
?>