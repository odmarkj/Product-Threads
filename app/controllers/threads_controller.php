<?php
class ThreadsController extends AppController {

	var $name = 'Threads';
	var $helpers = array('Html', 'Form', 'Crumb');
	var $uses = array('Thread','Topic','User');
	
	function beforeFilter(){
		$this->Auth->authorize = 'controller';
		$this->Auth->allow('index','view','search');
	}
	
	function isAuthorized(){
		if($this->Auth->user('role') == 'admin' || $this->Auth->user('role') == 'mod'){
			return true;
		}else{
			$this->Session->setFlash(__('You are not authorized to view this page.', true));
			return false;
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Thread.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('thread', $this->Thread->read(null, $id));
	}

	function add($topic_id = null) {
		if(!$topic_id){
			$this->Session->setFlash(__('No topic was defined.', true));
			$this->redirect('/topics');
			exit();
		}
		if (!empty($this->data)) {
			$this->Thread->create();
			if ($this->Thread->save($this->data)) {
				//Now that it has been saved, update the topic record
				$target_topic['Topic']['last_thread_id'] = $this->Thread->id;
				$target_topic['Topic']['last_poster_id'] = $this->Auth->user('id');
				$target_topic['Topic']['last_poster_name'] = $this->Auth->user('username');
				$target_topic['Topic']['last_post_time'] = date("Y-m-d H:m:s");
				
				//Set the ID for the update
				$this->Topic->id = $topic_id;
				
				//Update the replies count
				$this->Topic->doIncrement($topic_id,'replies'); 
				
				//Update the topic
				$this->Topic->save($target_topic);
				
				$this->Session->setFlash(__('The Thread has been saved', true));
				$this->redirect('/topics/view/'.$this->data['Thread']['topic_id']);
			} else {
				$this->Session->setFlash(__('The Thread could not be saved. Please, try again.', true));
			}
		}
		$this->set('topic',$this->Topic->find('first', array('conditions'=>array('Topic.id'=>$topic_id))));
		$this->set('topic_id',$topic_id);
		$this->set('user_profile',$this->Session->read());
		//$this->set(compact('topics'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Thread', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Thread->save($this->data)) {
				$this->Session->setFlash(__('The Thread has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Thread could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Thread->read(null, $id);
		}
		$topics = $this->Thread->Topic->find('list');
		$this->set(compact('topics'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Thread', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Thread->del($id)) {
			$this->Session->setFlash(__('Thread deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>