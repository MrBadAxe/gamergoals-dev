<?php

namespace GamerGoals;
use PDO;
use Exception;

class DatabaseHandler{

	private static $mDBH;

	private function __construct(){}

	public static function getInstance(){
		if(!isset(self::$mDBH)){
			self::$mDBH = new DatabaseHandler();
		}
		return self::$mDBH;
	}

	private function openConnection(){
		$cfg = parse_ini_file("./db.ini");
		$dsn = "mysql:dbname=".$cfg['db'].";host=".$cfg['hostname'];
		try{
			$dbh = new PDO($dsn,$cfg['user'],$cfg['pass']);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
		//echo $q."\n";
		//print_r($params);
		//echo "\n";

		$db = self::openConnection();
		$st = $db->prepare($q);

		foreach(array_keys($params) as $k){
			//echo $k.":".$params[$k]."\n";
			$st->bindValue($k,$params[$k]);
		}

		if($st->execute()){
			return $st->fetch(PDO::FETCH_ASSOC);
		}else{
			$st->debugDumpParams();
			throw new Exception("Query failed");
		}
	}
	
	public static function queryMultiRowResult($q,array $params){
		$db = self::$mConnection;
		$st = $db->prepare($q);
		$st->execute($params);
		return $st->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>
