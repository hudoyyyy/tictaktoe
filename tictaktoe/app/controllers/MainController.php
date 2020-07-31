<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

    public function index(){
        if(isset($_SESSION['Id'])){
            $this->view->redirect('/home');
        }
        $this->view->render('Main page' );
    }


}
