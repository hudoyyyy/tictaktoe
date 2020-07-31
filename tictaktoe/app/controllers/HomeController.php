<?php

namespace app\controllers;

use app\core\Controller;

class HomeController extends Controller
{

    public function home()
    {
        if(!(isset($_SESSION['id']))){
            $this->view->redirect('/');
        }
        $currentUserLogin = $this->model->getLogin($_SESSION['id']);
        $gamesForJoin = $this->model->getGamesForJoin($_SESSION['id']);
        $gamesForCurrentUser = $this->model->getGamesForCurrentUser($_SESSION['id']);
        foreach ($gamesForJoin as $key => $val){
            array_push($logins, $this->model->getLogin($val['first_id']));
        }
        $vars = [
            'currentUserLogin' => $currentUserLogin,
            'gamesForJoin' => $gamesForJoin,
            'gamesForCurrentUser' => $gamesForCurrentUser,
        ];

        $this->view->render('Home page', $vars);
    }

    public function getStatistic(){
        $statistic = $this->model->getStatistic($_SESSION['id']);
        $statistic_array = [$statistic['0']['full_count'], $statistic['0']['wins'], $statistic['0']['loses'], $statistic['0']['draws']];
        echo json_encode($statistic_array);
    }

    public function homeLogout()
    {
        session_destroy();
        $this->view->location('/');
    }

    public function create()
    {
        $this->model->createGame($_SESSION['id']);
        $game_id = $this->model->getGameId($_SESSION['id']);
        $_SESSION['game_id'] = $game_id;
        $this->view->location('/game');
    }

}
