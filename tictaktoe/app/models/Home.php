<?php

namespace app\models;

use app\core\Model;

class Home extends Model
{

    public function createGame($userid)
    {
        $this->getQuery("INSERT INTO game
                            (first_id)
	                        VALUES('" . $userid . "')");

    }

    public function getLogin($user_id)
    {
        $login = $this->getRow("SELECT login FROM Users WHERE id='" . $user_id . "'");
        return $login['0']['login'];
    }

    public function getGamesForJoin($user_id)
    {
        return $this->getRow("SELECT id, first_id, second_id FROM game WHERE status=0 AND first_id != '".$user_id."'");
    }

    public function getGamesForCurrentUser($user_id)
    {
        return $this->getRow("SELECT id, first_id, second_id FROM game WHERE ( status=1 OR status = 0 ) AND (first_id = '" . $user_id . "' OR second_id = '" . $user_id . "')");
    }

    public function  getStatistic($user_id){
        return $this->getRow("SELECT full_count, wins, loses, draws FROM statistic WHERE user_id = '".$user_id."'");
    }

    public function getGameId($game_id){
        $id = $this->getRow("SELECT id FROM game WHERE id=last_insert_id() AND first_id = '".$game_id."'");
        return $id['0']['id'];
    }

}