<?php

namespace app\models;

use app\core\Model;

class Game extends Model {

    public function getLogin($user_id){
        $login = $this->getRow("SELECT login FROM Users WHERE id='".$user_id."'");
        return $login['0']['login'];
    }

    public function getUsersId($id){
        return $this->getRow("SELECT first_id, second_id FROM game WHERE id='".$id."'");
    }

    public function setSecondId($id, $game_id){
        $this->getQuery("UPDATE game SET second_id = '".$id."', status = 1 WHERE id = '".$game_id."'");
    }

    public function setEndStatus($game_id){
        $this->getQuery("UPDATE game SET status = 2, turn = 2 WHERE id = '".$game_id."'");
    }

    public function sendField($game_id, $game_field, $turn){
        $this->getQuery("UPDATE game SET game_field = '".$game_field."', turn = '".$turn."' WHERE id = '".$game_id."'");
    }

    public function getId($game_id){
        return $this->getRow("SELECT first_id FROM game WHERE id = '".$game_id."'" );
    }

    public function getUserId($user_login){
        return $this->getRow("SELECT id FROM Users WHERE login = '".$user_login."'" );
    }

    public function getGameField($game_id){
        return $this->getRow("SELECT game_field FROM game WHERE id = '".$game_id."'" );
    }

    public function getGameTurn($game_id){
        return $this->getRow("SELECT turn FROM game WHERE id = '".$game_id."'" );
    }

    public function getFullCount($user_id){
        return $this->getRow("SELECT full_count FROM statistic WHERE user_id = '".$user_id."'");
    }

    public function getWins($user_id){
        return $this->getRow("SELECT wins FROM statistic WHERE user_id = '".$user_id."'");
    }

    public function getLoses($user_id){
        return $this->getRow("SELECT loses FROM statistic WHERE user_id = '".$user_id."'");
    }

    public function getDraws($user_id){
        return $this->getRow("SELECT draws FROM statistic WHERE user_id = '".$user_id."'");
    }

    public function setGameWin($user_id, $fullcount, $wins){
        return $this->getQuery("UPDATE statistic SET full_count = '".$fullcount."' , wins = '".$wins."' WHERE user_id = '".$user_id."'");
    }

    public function setGameLose($user_id, $fullcount, $loses){
        return $this->getQuery("UPDATE statistic SET full_count = '".$fullcount."', loses = '".$loses."' WHERE user_id = '".$user_id."'");
    }

    public function setGameDraw($user_id, $fullcount, $draws){
        return $this->getQuery("UPDATE statistic SET full_count = '".$fullcount."', draws = '".$draws."' WHERE user_id = '".$user_id."'");
    }

    public function checkStatus($game_id){
        $status = $this->getRow("SELECT status FROM game WHERE id = '".$game_id."'");
        return $status['0']['status'];
    }

}