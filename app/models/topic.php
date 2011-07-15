<?php
class Topic extends AppModel {

	var $name = 'Topic';
	var $belongsTo = array('Record','User');
	var $actsAs = array ('Searchable');
	var $hasMany = array('Thread');
	var $validate = array('title'=>array('rule'=>'isUnique'),'body'=>array('rule'=>'isUnique'));
	
	function doIncrement($id,$field)
	{
	  //debug ($this->useTable);exit;
	  $this->query("UPDATE $this->useTable SET $field=$field+1 WHERE id=$id"); 
	}
}
?>