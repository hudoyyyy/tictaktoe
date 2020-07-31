<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Game;

class GameController extends Controller
{

    public function game()
    {
            $gamers_id = $this->model->getUsersId($_SESSION['game_id']);
            if (($gamers_id['0']['first_id'] == $_SESSION['id'] || $gamers_id['0']['second_id'] == $_SESSION['id']) && $gamers_id['0']['second_id'] != null) {
                $first_login = $this->model->getLogin($gamers_id['0']['first_id']);
                $second_login = $this->model->getLogin($gamers_id['0']['second_id']);
                $vars = [
                    'game_id' => $_SESSION['game_id'],
                    'first_gamer' => $first_login,
                    'second_gamer' => $second_login,
                ];
                //unset($_SESSION['game_id']);
                $this->view->render('Game page', $vars);
            } else if ($gamers_id['0']['second_id'] == null && $gamers_id['0']['first_id'] != $_SESSION['id']) {
                $this->model->setSecondId($_SESSION['id'], $_SESSION['game_id']);
                $first_login = $this->model->getLogin($gamers_id['0']['first_id']);
                $second_login = $this->model->getLogin($_SESSION['id']);
                $vars = [
                    'game_id' => $_SESSION['game_id'],
                    'first_gamer' => $first_login,
                    'second_gamer' => $second_login,
                ];
                //unset($_SESSION['game_id']);
                $this->view->render('Game page', $vars);
            } else if ($gamers_id['0']['first_id'] != $_SESSION['id'] && $gamers_id['0']['second_id'] != $_SESSION['id']) {
                //unset($_SESSION['game_id']);
                $this->view->redirect('/home');
            } else if($gamers_id['0']['second_id'] == null && $gamers_id['0']['first_id'] == $_SESSION['id']){
            $first_login = $this->model->getLogin($_SESSION['id']);
            $vars = [
                'game_id' => $_SESSION['game_id'],
                'first_gamer' => $first_login,
            ];
            $this->view->render('Game page', $vars);
        }

    }

    public function gameJoin()
    {
        $_SESSION['game_id'] = $_REQUEST['id'];
        $this->view->location('/game');
    }

    public function sendField()
    {
        $game_id = $_POST['id'];
        $game_field = $_POST['game_field'];
        $db_game_field = $this->model->getGameField($game_id);
        $db_turn = $this->model->getGameTurn($game_id);
        $turn = 0;
        if($db_turn['0']['turn'] == 0) { $turn = 1;}
        if ($db_game_field['0']['game_field'] == null) {
            $this->model->sendField($game_id, $game_field, $turn);
        } else {
            $this->model->sendField($game_id, $db_game_field['0']['game_field'] . ',' . $game_field, $turn);
        }
    }

    public function gameEnd(){
        $status = $_POST['status'];
        $whoWon_id = $this->model->getUserId($_POST['whoWon']);
        $whoLost_id = $this->model->getUserId($_POST['whoLost']);
        $winnerFullcount = $this->model->getFullCount($whoWon_id['0']['id']);
        $winnerWins = $this->model->getWins($whoWon_id['0']['id']);
        $winnerDraws = $this->model->getDraws($whoWon_id['0']['id']);
        $loserFullcount = $this->model->getFullCount($whoLost_id['0']['id']);
        $loserLoses = $this->model->getLoses($whoLost_id['0']['id']);
        $loserDraws = $this->model->getDraws($whoLost_id['0']['id']);
        if(status == 1){
            $fp_fullcount = $winnerFullcount['0']['full_count'] + 1;
            $sp_fullcount = $loserFullcount['0']['full_count'] + 1;
            $wins = $winnerWins['0']['wins'] + 1;
            $loses = $loserLoses['0']['loses'] + 1;
            $this->model->setGameWin($whoWon_id['0']['id'], $fp_fullcount, $wins);
            $this->model->setGameLose($whoLost_id['0']['id'], $sp_fullcount, $loses);
        }
        if($status == 0){
            $fp_fullcount = $winnerFullcount['0']['full_count'] + 1;
            $sp_fullcount = $loserFullcount['0']['full_count'] + 1;
            $wins = $winnerWins['0']['wins'] + 1;
            $loses = $loserLoses['0']['loses'] + 1;
            $this->model->setGameWin($whoWon_id['0']['id'], $fp_fullcount, $wins);
            $this->model->setGameLose($whoLost_id['0']['id'], $sp_fullcount, $loses);
        }
        if($status == 2){
            $fp_fullcount = $winnerFullcount['0']['full_count'] + 1;
            $sp_fullcount = $loserFullcount['0']['full_count'] + 1;
            $fp_draws = $winnerDraws['0']['draws'] + 1;
            $sp_draws = $loserDraws['0']['draws'] + 1;
            $this->model->setGameDraw($whoWon_id['0']['id'], $fp_fullcount, $fp_draws);
            $this->model->setGameDraw($whoLost_id['0']['id'], $sp_fullcount, $sp_draws);
        }
        $this->model->setEndStatus($_POST['id']);
        unset($_SESSION['game_id']);
    }

    public function getField()
    {
        $game_id = $_POST['id'];
        $game_field = $this->model->getGameField($game_id);
        echo $game_field['0']['game_field'];
    }

    public function getTurn()
    {
        $game_id = $_POST['id'];
        $game_turn = $this->model->getGameTurn($game_id);
        echo $game_turn['0']['turn'];
    }

    public function whoami()
    {
        $user_id = $this->model->getId($_POST['id']);
        if ($_SESSION['id'] == $user_id['0']['first_id']) {
            echo 0;
        } else {
            echo 1;
        }
    }

    public function checkConnection(){
        $status = $this->model->checkStatus($_POST['id']);
        if($status == 1) {
            $users = $this->model->getUsersId($_POST['id']);
            echo $this->model->getLogin($users['0']['second_id']);
        }

    }

}
