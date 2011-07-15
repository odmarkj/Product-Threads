<?php

class UsersController extends AppController
{
	var $name = 'Users';
	var $components = array('Auth','Cookie');
	var $helpers = array('Html', 'Form', 'Crumb');
	
	function index(){
		if(!$this->Auth->user()){
			$this->Session->setFlash(__('You are currently not logged in.', true));
			$this->redirect(array('action'=>'login'));
			exit();
		}
		$this->set('user_stats', $this->Cookie->read());
		$this->set('test', $this->Auth->user());
		$this->set('user', $this->User->read(null, $this->Auth->user('id')));
	}
	
	function view($id = null){
		if (!$id) {
			$this->Session->setFlash(__('Invalid User Id.', true));
			$this->redirect();
			exit();
		}
		$this->set('user', $this->User->read(null, $id));
	}
	
	function login()
	    {
					$this->layout = 'nolayout';
	        //user already logged in?
	        //checking if session has been written
	        $user_id = $this->Auth->user('id');
	        if (!empty($user_id) && $this->Session->valid())
	        {
	            $this->Session->setFlash('You are already logged in');
	            $this->redirect("/users", null, true);
	        }
	        else
	        {
	            if(!empty($this->data))
	            {
	                //calling login validation validLogin() in model
	                if($this->User->validLogin($this->data))
	                {
	                    if($this->Auth->login($this->User->user))
	                    {
													//$this->Cookie->write('lastLogin',time(),false, 3600);
	                        $this->Session->setFlash('You have
	successfully logged in');
	                        $this->redirect("/users", null,
	true);
	                    }
	                    else
	                    {
	                        $this->set('password', null);
	                        $this->set('auth_msg', 'Please try again');
	                    }

	                }
	            }
	            else
	            {
	                $this->set('auth_msg', 'Please enter your username and
	password');
	            }
	        }

	    }
	
	function logout(){
		$this->redirect($this->Auth->logout());
	}
}
?>