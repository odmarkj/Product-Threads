<?php
class Thread extends AppModel {
	var $name = 'Thread';
	var $belongsTo = array('Topic','User');
}
?>