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
		$z .= self::generateStatusButton($g,$c);

		$z .= "</div>";
		
		$z .= "</div>";

		return $z;		
	}

	private static function generateStatusButton(Game $g, Collection $c = NULL){
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
