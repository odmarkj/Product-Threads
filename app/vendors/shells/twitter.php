<?
App::import('ConnectionManager');
class TwitterShell extends Shell {
	var $uses = array('Record','User','Topic');
	
	function main(){
		$theRecord = $this->Record->find('all');
		//var_dump($theRecord);
		
		foreach($theRecord as $record):
			//var_dump($record);
			//echo $record['Record']['name']."<br>";
			if($record['Record']['id'] > 0 && $record['Record']['id'] != ""){
				echo $record['Record']['id']."|".$record['Record']['name'];
				$keyword = $record['Record']['name'];
				$record_id = $record['Record']['id'];
				$vem = array();
				$user_stuff = array();
		    $this->Twitter =& ConnectionManager::getDataSource('twitter');
		    $search_results = $this->Twitter->search($keyword, 'en', 5);
	
				foreach($search_results['Feed']['Entry'] as $result):
		
					$img = $result['Link']['href'];
					$temp_user = $result['Author']['name'];
					$exp_user = explode(" ",$temp_user);
					if($img != "http://s.twimg.com/a/1250809294/images/default_profile_normal.png" && $img != "http://s.twimg.com/a/1252448032/images/default_profile_normal.png"){
						$vem['record_id'] = $record_id;
						$vem['type'] = "twitter";
						$vem['title'] = $result['title'];
						$vem['body'] = $result['title'];
			
						$user_stuff['profile_image_url'] = $img;
						$user_stuff['username'] = $exp_user[0];
						$user_stuff['role'] = "user";
						$user_stuff['type'] = "twitter";
			
						$time = strtotime($result['published']);
						$vem['published'] = date("Y-m-d H:m:s", $time);
						$vem['raw_date'] = $result['published'];
			
						$checkUser = $this->User->find('first',array('conditions'=>array('User.username'=>$user_stuff['username'])));
			
						if(empty($checkUser)){
							$this->User->create();
							$this->User->save($user_stuff);
			
							$vem['user_id'] = $this->User->id;
						}else{
							$vem['user_id'] = $checkUser['User']['id'];
						}
			
						if($this->checkForBadTweet($result['title']) == false && $record_id > 0){
							$this->Topic->create();
							$this->Topic->save($vem);
						}
					}
				endforeach;
			}
		endforeach;
  }

	function checkForBadTweet($tweet = null){
		$ignoreWords = array("giveaway","for sale","forsale","click here","clickhere");
		
		//If the word exists, return true for a bad tweet so it is not put into the DB
		foreach($ignoreWords as $word):
			if(stripos($tweet, $word) !== false)
				return true;
		endforeach;
		
		return false;
	}
}
?>