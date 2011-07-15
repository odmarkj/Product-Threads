<?php
class User extends AppModel
{
	var $name = 'User';
	var $hasMany = array('Topic');
	var $hasAndBelongsToMany = array('Record');
	var $validate = array('username'=>array('rule'=>'isUnique'));
}
?>