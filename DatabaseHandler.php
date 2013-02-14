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

	public static function querySingleRowResult($q,array $params){
		$db = this->openConnection();
		$st = $db->prepare($q);
		$st->execute($params);
		return $st->fetch(PDO::FETCH_ASSOC);
	}
	
	public static function queryMultiRowResult($q,array $params){
		$db = this->openConnection();
		$st = $db->prepare($q);
		$st->execute($params);
		return $st->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>
