<?php
class Announcement extends AppModel {

	var $name = 'Announcement';
	var $belongsTo = array('Record','User');

}