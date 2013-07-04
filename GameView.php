<?php
namespace GamerGoals;

include_once "./Game.php";
include_once "./Collection.php";
use GamerGoals\Game;
use GamerGoals\Collection;

class GameView{

	private static $gv;
	private static $platforms;
	private static $statuses;

	private function __construct(){}

	private static function buildPlatformList($file){
		if(($list = file($file)) !== FALSE){
			foreach($list as $line){
				$data = str_getcsv($line,':');
				self::$platforms[$data[0]] = $data[1];
			}
		}
	}
	private static function buildStatusList($file){
		if(($list = file($file)) !== FALSE){
			foreach($list as $line){
				//echo $line."\n";
				$data = str_getcsv($line,':');
				self::$statuses[$data[0]] = $data[1];
			}
		}
	}

	public static function getInstance(){
		if(!isset($gv)){
			$gv = new GameView();
		}
		return $gv;
	}
	public static function formatPlatform($key){
		self::buildPlatformList("./platform-list.txt");
		return self::$platforms[$key];	
	}
	public static function formatStatus($key){
		self::buildStatusList("./status-list.txt");
		return self::$statuses[$key];	
	}

	public static function toSearchResultRow(Game $g, Account $a = NULL){
		$z = '<div class="row well well-small">';

		$z .= '<div class="span4">';
		$z .= '<strong><a href="viewgame.php?id='.$g->getGameId().'">'.$g->getName().'</a></strong><br/>';
		$z .= 'for <em>'.self::formatPlatform($g->getPlatform()).'</em> ('.$g->getYear().')';
		$z .= "</div>";		
		
		$z .= '<div class="span5">';
		if($g->getDeveloper() === $g->getPublisher()){	
			$z .= 'Developed and Published<br/>by <strong>'.$g->getDeveloper().'</strong>';
		}else{
			$z .= 'Developed by <strong>'.$g->getDeveloper().'</strong>';
			$z .= "<br/>";		
			$z .= 'Published by <strong>'.$g->getPublisher().'</strong>';
		}
		$z .= "</div>";

		$z .= '<div class="span3">';
		$z .= self::generateStatusButton($g,$a);

		$z .= "</div>";
		
		$z .= "</div>";

		return $z;		
	}

	public static function toCollectionItem(OwnedGame $og){
		$g = $og->getGame();
		$z = '<div class="row well well-small">';
		$z .= '<div class="span4">';
		$z .= '<strong><a href="viewgame.php?id='.$g->getGameId().'">'.$g->getName().'</a></strong>';
		$z .= '</div>';
		$z .= '<div class="span4">';
		$z .= '<em>'.self::formatPlatform($g->getPlatform()).'</em>';
		$z .= '</div>';
		$z .= '<div class="span4">';
		$z .= '<strong>'.self::formatStatus($og->getStatus()).'</strong>';
		$z .= '</div>';
		$z .= '</div>';	
		return $z;	
	}

	public static function generateStatusButton(Game $g, Account $a = NULL){
		$c = new Collection($a);
		$name = strtolower($g->getName());
		$name = str_replace(' ','_',$name);
		$name = str_replace(':','',$name);
		$name = str_replace('.','',$name);
		$name = str_replace('!','',$name);

		$id = "btn_".$name."_".$g->getPlatform();

		$btn = '<a id="'.$id.'" class="btn btn-large btn-block';

		if($c == NULL || $c->getUserId() == 0){
			$btn .= '" href="login.php">Login to Add';
		}elseif(!$c->hasGame($g)){
			$btn .= '" onclick="add(';
			$btn .= "'" . $id . "'" .',';
			$btn .= "'" . $c->getUserId() . "'" . ',';
			$btn .= "'" . $g->getGameId() . "'";
			$btn .= ')">Add to My Games';
		}else{
			$btn .= ' btn-primary" href="my.php">In My Collection';
		}
		$btn .= '</a>';
		return $btn;
	}

}
?>
