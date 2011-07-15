<?php
class TopicsController extends AppController {

	var $name = 'Topics';
	var $helpers = array('Html', 'Form', 'Crumb', 'Time');
	var $uses = array('Topic','Topicview','User');
	var $components = array('Cookie');
	
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

	function index() {
		$this->Topic->recursive = 0;
		$this->set('topics', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Topic.', true));
			$this->redirect(array('action'=>'index'));
		}
		$theTopic = $this->Topic->find('all',array('conditions'=>array("Topic.id"=>$id),'recursive'=>'1'));
		$this->set('topic', $theTopic);
		$threads = $this->Topic->Thread->find('all',array('conditions'=>array('Topic.id'=>$id),'recursive'=>'1'));
		$this->set(compact('topic','threads'));
		$this->set('record_name', $theTopic[0]['Record']['name']." ");
		$this->set('record_link', "records/view/".$theTopic[0]['Record']['id']);
		$this->set('breadcrumb', $this->getBreadcrumb("Topic", $theTopic[0]['Record']['name'], $theTopic[0]['Record']['id'], $theTopic[0]['Topic']['title']));
		//Sets a cookie
		$this->setUserActivity('topicActivity', array($theTopic[0]['Topic']['id'],$theTopic[0]['Topic']['title']), "");
		//Updates the topicviews database with user information
		$this->recordActivity($id);
		//Increments topic view field in topics
		$this->Topic->doIncrement($id,'views');
	}

	function add($record_id = null) {
		if(!$record_id){
			$this->Session->setFlash(__('No record was defined.', true));
			$this->redirect('/records');
			exit();
		}
		if (!empty($this->data)) {
			$this->Topic->create();
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The Topic has been saved', true));
				$this->redirect('/records/view/'.$this->data['Topic']['record_id']);
			} else {
				$this->Session->setFlash(__('The Topic could not be saved. Please, try again.', true));
			}
		}
		$records = $this->Topic->Record->find('list');
		$this->set('record_id',$record_id);
		$this->set('user_profile',$this->Session->read());
		$this->set(compact('records'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Topic', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The Topic has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Topic could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Topic->read(null, $id);
		}
		$records = $this->Topic->Record->find('list');
		$this->set(compact('records'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Topic', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Topic->del($id)) {
			$this->Session->setFlash(__('Topic deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function search() {
		$this->set('record_id',$this->data['Topic']['record_id']);
		$this->set('results',$this->Topic->search($this->data['Topic']['q'],array('conditions'=>array('Topic.record_id'=>$this->data['Topic']['record_id']),'recursive'=>'2')));
  }

	function recordActivity($id = null)
	{
		if (!$id) {
			//exit();
		}else{
			// The following line makes this script work for CakePHP installations that use either mod_rewrite or CakePHP's own URL shortening tricks.
			$pages = explode("/", $_SERVER['REQUEST_URI']);

			// You will probably all reconise this, we are just getting all the values we need to store and assigning them to CakePHP.
			$this->data['Topicview']['topic_id'] = $id;
			$this->data['Topicview']['model'] = $pages[1];
			$this->data['Topicview']['action'] = $pages[2];
			$this->data['Topicview']['user_ip'] = $_SERVER['REMOTE_ADDR'];
			$this->data['Topicview']['user_browser'] = $_SERVER['HTTP_USER_AGENT'];
			if(isset($_SERVER['HTTP_REFERER'])){
				$referer = $_SERVER['HTTP_REFERER'];
			}else{
				$referer = '';
			}
			$this->data['Topicview']['clicked_from'] = $referer;
			$this->data['Topicview']['user_accessed'] = date("Y-m-d H:i:s");

			// O.K, now we just need to call the insert query:
			$this->Topicview->save($this->data);

			// The following line is a fix by Termnial13 (thanks). It removes tracker stuffs from $this->data as it was causing some users issues.
			unset($this->data['Tracker']);
		}
	}

}
?>