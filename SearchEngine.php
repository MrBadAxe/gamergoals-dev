<?php

namespace GamerGoals;

include_once "./DatabaseHandler.php";
include_once "./Game.php";
use GamerGoals\DatabaseHandler;
use GamerGoals\Game;

class SearchEngine{
	private function __construct(){}

	private static $se;

	public static function getInstance(){
		if(self::$se == NULL){
			self::$se = new SearchEngine();
		}
		return self::$se;
	}

	private static function tokenizeQuery($q){
		$mQuery = $q;
		$z = array();

		$mTokens = explode(';',$q);
		foreach($mTokens as $token){
			$kv = explode(':',$token);
			$key = $kv[0];
			$val = $kv[1];
			$z[$key] = $val;
		}
		return $z;
	}

	private static function findByCategory($k,$v){
		$dbh = DatabaseHandler::getInstance();
		$results = $dbh::queryMultiRowResult("select * from games where :key like '%:value%",array('key'=>$k,'value'=>$v));
		
		$z = array();
		foreach($results as $row){
			array_push($z,new Game());
		}
		return $z;
	}

	private static function buildQuery(array $subTerms){
		
		$whereclauses = array();
		foreach(array_keys($subTerms) as $k){
			$wc = "";
			if($k == 'year' || $k == 'platform'){
				$wc .= $k." = :".$k;
			}else{
				$wc .= $k." like %:".$k."%";
			}
			array_push($whereclauses,$wc);
		}
		$sql = "select * from games where ".implode(" and ",$whereclauses);
		return $sql;
	}

	public static function findGames($terms){
		$mTerms = $terms;
		$z = array();
		$dbh = DatabaseHandler::getInstance();
		$q = "";
		
		if(strpos($terms,';') != FALSE){
			$subTerms = self::tokenizeQuery($terms);
			$q = self::buildQuery($subTerms);
			$results = $dbh::queryMultiRowResult($q,$subTerms);
			foreach($results as $row){
				$g = Game::fromResultRow($row);
				array_push($z,$g);
			}
		}else{
			$searches = array('name','developer','publisher','year');
			foreach($searches as $s){
				$q = "select * from games where ".$s." like :$s";
				//echo $q;
				$t = array(':'.$s => "%".$terms."%");
				//print_r($t);

				$results = $dbh::queryMultiRowResult($q,$t);
				foreach($results as $row){
					$g = Game::fromResultRow($row);
					if(!in_array($g,$z)){	array_push($z,$g);	}
				}
			}
		}	
		return $z;
	}
}

?>
