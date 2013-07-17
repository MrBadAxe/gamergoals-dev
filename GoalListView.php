<?php
namespace Gamergoals;

include_once './Game.php';
include_once './NumericGoal.php';
include_once './GoalList.php';
use Gamergoals\Game;
use Gamergoals\NumericGoal;
use Gamergoals\GoalList;

class GoalListView{

	private $mGoalList;

	public function __construct(GoalList $gl){
		$this->mGoalList = $gl;
	}

	public function getGoalList(){
		return $this->mGoalList;
	}

	public function displayGoalsForGame(Game $game){
		$z = '<div class="row-fluid">';
		#$z .= print_r($this->getGoalList());
		foreach($this->getGoalList()->getGoalsForGame($game) as $goal){
			if($goal->getParent() == NULL){
				$z .= $this->displayGoalWithSubgoals($goal);
				#$z .= print_r($goal);
			}
		}
		$z .= '</div>';
		return $z;
	}

	private function displayCompletionPercentage(NumericGoal $n){
		$z = "";
		if($n->getCurrent() >= $n->getTarget()){
			$z .= "Complete";
		}else{
			if($n->getTarget() == 1){
				$z .= "Incomplete";
			}else{
				$z .= '<div class="progress">';
				$z .= '<div class="bar" style="width: '.(100 * ($n->getCurrent() / $n->getTarget()) ).'%">';
				$z .= '</div>';
			}
		}
		return $z;
	}

	private function displayGoalWithSubgoals(NumericGoal $n){
		$z = '<div class="container-fluid well well-small">';

		$z .= '<div class="row-fluid">';
			$z .= '<div class="span4">'.$n->getDescription().'</div>';
			$z .= '<div class="span6">';
				$z .= $this->displayCompletionPercentage($n);
			$z .= '</div>';
			$z .= '<div class="span2">'.'</div>'; #update button
		$z .= '</div>';

		$sgs = $this->getSubgoals($n);
		if(count($sgs) > 0){
			$z .= '<div class="row-fluid"><div class="span10 offset1">';
			foreach($sgs as $s){
				$z .= '<div class="row-fluid">';
				$z .= $this->displayGoalWithSubgoals($s);
				$z .= '</div>';
			}
			$z .= '</div></div>';
		}else{
			$z .= "";
		}

		$z .= '</div>';
		return $z;
	}

	private function getSubgoals(NumericGoal $n){
		$sg = array();
		foreach($this->getGoalList()->getNumericGoalsList() as $g){
			if($g->getParent() == $n->getGoalId()){
				array_push($sg, $g);
			}
		}
		return $sg;
	}
}

?>
