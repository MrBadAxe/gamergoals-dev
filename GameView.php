<?php
namespace GamerGoals;

include_once "./Game.php";
use GamerGoals\Game;

class GameView{

	private static $gv;
	private static $platforms;

	private function __construct(){}

	private static function buildPlatformList($file){
		if(($list = file($file)) !== FALSE){
			foreach($list as $line){
				$data = str_getcsv($line,':');
				self::$platforms[$data[0]] = $data[1];
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

	public static function toSearchResultRow(Game $g, Collection $c = NULL){
		$z = '<div class="row well well-small">';

		$z .= '<div class="span4">';
		$z .= '<strong>'.$g->getName().'</strong><br/>';
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
		if($c != NULL && $c->hasGame($g)){
			$z .= '<button class="btn btn-large btn-primary">In My Collection</button>';	
		}else{
			$z .= '<button class="btn btn-large">Add to My Games</button>';
		}

		$z .= "</div>";
		
		$z .= "</div>";

		return $z;		
	}

}
?>
