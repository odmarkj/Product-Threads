<?php
class Record extends AppModel {

	var $name = 'Record';
	var $actsAs = array ('Searchable'); 
	var $hasMany = array('Topic' => array('order'=> 'Topic.created DESC','limit' => '20'),'Announcement'=>array('order'=>'Announcement.created DESC','limit'=>'3'));
	var $hasAndBelongsToMany = array('Tag');
	
}
?>