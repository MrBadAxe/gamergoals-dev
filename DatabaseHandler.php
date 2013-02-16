<?php

namespace GamerGoals;
use PDO;

class DatabaseHandler{

	private $mDBH;

	private function __construct(){}

	public function getInstance(){
		if($mDBH == null){
			$mDBH = new DatabaseHandler();
		}
		return $mDBH;
	}

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

	public static function queryNoResult($q,array $params){
		$db = self::openConnection();
		$st = $db->prepare($q);
		$st->execute($params);
	}

	public static function querySingleRowResult($q,array $params){
		$db = self::openConnection();
		$st = $db->prepare($q);
		$st->execute($params);
		if($st == NULL){
			return FALSE;
		}else{
			return $st->fetch(PDO::FETCH_ASSOC);
		}
	}
	
	public static function queryMultiRowResult($q,array $params){
		$db = self::openConnection();
		$st = $db->prepare($q);
		$st->execute($params);
		return $st->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>
