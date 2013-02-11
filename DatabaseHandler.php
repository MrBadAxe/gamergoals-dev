<?php

class DatabaseHandler{

	private function openConnection(){
		$cfg = parse_ini_file("../db.ini");
		$dsn = "mysql:dbname=".$cfg['db'].";host=".$cfg['hostname'];
		try{
			$dbh = new PDO($dsn,$cfg['user'],$cfg['pass']);
		}catch(PDOException $e){
			echo 'Could not connect: '.$e->getMessage();
			return 0;
		}
		return $dbh;	
	}

	public function getGameById($id){
		$db = this->openConnection();
		return 0;
	}	
	
}

?>
