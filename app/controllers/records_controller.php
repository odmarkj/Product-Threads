<?php
class RecordsController extends AppController {

	var $name = 'Records';
	var $helpers = array('Html', 'Form', 'Crumb', 'Time');
	var $uses = array('Record','Recordview','Topic','Topicview','Announcement');
	var $components = array('Cookie');
	
	function beforeFilter(){
		$this->Auth->authorize = 'controller';
		$this->Auth->allow('index','view','search','rss','ssearch');
	}
	
	function isAuthorized(){
		if($this->Auth->user('role') == 'admin'){
			return true;
		}else{
			$this->Session->setFlash(__('You are not authorized to view this page.', true));
			return false;
		}
	}
	
	function beforeRender(){
		
	}
	
	function rss($id = null)
	{
		//Disable debug so I can see the XML easily.
		Configure::write('debug', '0');
		if (!$id) {
			$this->Session->setFlash(__('Invalid topic request.', true));
			$this->redirect(array('action'=>'index'));
		}
  	$this->layout = 'xml';
		$this->set('record', $this->Record->find(array('Record.id'=>$id)));
    $this->set('topics', $this->Topic->find('all',array("conditions"=>array("Topic.record_id = ".$id),"limit"=>"20")));
  }

	function index() {
		//$this->Record->recursive = 0;
		//$this->set('records', $this->paginate());
		$this->redirect('/users');
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Record.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->dumpCookie();
			
		//$this->set('thistest', $this->Record->find('all'));
		$theRecord = $this->Record->find('all', array('conditions'=>array('Record.id'=>$id),'recursive'=>'2'));
		$this->setUserActivity('forumActivity', array($theRecord[0]['Record']['id'],$theRecord[0]['Record']['name']), "");
		$this->set('active', $this->Topic->find('all', array('conditions'=>array("Topic.record_id"=>$id,"Topic.replies > 0"),'order'=>'Topic.published DESC','limit'=>'20')));
		$this->set('popular', $this->Topic->find('all', array('conditions'=>array("Topic.record_id"=>$id,'Topic.replies > 0'),'order'=>array('Topic.replies DESC','Topic.views DESC'),'limit'=>'20')));
		$this->set('record', $theRecord);
		$this->set('record_name', $theRecord[0]['Record']['name']." ");
		$this->set('record_link', "records/view/".$theRecord[0]['Record']['id']);
		$this->set('breadcrumb', $this->getBreadcrumb("Record", $theRecord[0]['Record']['name']));
		$this->recordActivity($id);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Record->create();
			if ($this->Record->save($this->data)) {
				$this->Session->setFlash(__('The Record has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Record could not be saved. Please, try again.', true));
			}
		}
		$tags = $this->Record->Tag->find('list');
		$this->set(compact('tags'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Record', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Record->save($this->data)) {
				$this->Session->setFlash(__('The Record has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Record could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Record->read(null, $id);
		}
		$tags = $this->Record->Tag->find('list');
		$this->set(compact('tags'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Record', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Record->del($id)) {
			$this->Session->setFlash(__('Record deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function search() {
		$this->set('results',$this->Record->search($this->data['Record']['q'])); 
  }

	function recordActivity($id = null)
	{
		if (!$id) {
			//exit();
		}else{
			// The following line makes this script work for CakePHP installations that use either mod_rewrite or CakePHP's own URL shortening tricks.
			$pages = explode("/", $_SERVER['REQUEST_URI']);

			// You will probably all reconise this, we are just getting all the values we need to store and assigning them to CakePHP.
			$this->data['Recordview']['record_id'] = $id;
			$this->data['Recordview']['model'] = $pages[1];
			$this->data['Recordview']['action'] = $pages[2];
			$this->data['Recordview']['user_ip'] = $_SERVER['REMOTE_ADDR'];
			$this->data['Recordview']['user_browser'] = $_SERVER['HTTP_USER_AGENT'];
			if(isset($_SERVER['HTTP_REFERER'])){
				$referer = $_SERVER['HTTP_REFERER'];
			}else{
				$referer = '';
			}
			$this->data['Recordview']['clicked_from'] = $referer;
			$this->data['Recordview']['user_accessed'] = date("Y-m-d H:i:s");

			// O.K, now we just need to call the insert query:
			$this->Recordview->save($this->data);

			// The following line is a fix by Termnial13 (thanks). It removes tracker stuffs from $this->data as it was causing some users issues.
			unset($this->data['Tracker']);
		}
	}
}
?>