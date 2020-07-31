<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller {

    public function login(){
        if(isset($_SESSION['Id'])){
            $this->view->redirect('/home');
        }
        $this->view->render('Login Page');
    }

    public function loginPost(){
        if(!empty($_POST)) {
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $login = $_POST['login'];
                $pass_get = $_POST['password'];
                $user_pass = $this->model->getRow('SELECT password, id FROM Users WHERE login = "'.$login.'"');
                if (password_verify($pass_get, $user_pass['0']['password'])) {
                    $_SESSION['id'] = $user_pass['0']['id'];
                    $this->view->location('/home');
                } else {
                    $this->view->message('Error', 'You are not registered!');
                }
            } else {
                $this->view->message('Error', 'Some fields are empty!');
            }
        }
    }

    public function registration(){
        if(isset($_SESSION['Id'])){
            $this->view->redirect('/home');
        }
        $this->view->render('Register Page');
    }

    public function registrationPost(){
        if(isset($_POST)){
            if(!empty($_POST['loginReg']) && !empty($_POST['passwordReg'])){
                $login = $_POST['loginReg'];
                $password = password_hash($_POST['passwordReg'], PASSWORD_BCRYPT);
                $query = $this->model->getRow('SELECT login FROM Users WHERE login = "'.$login.'"');
                if(empty($query)){
                    $sql = "INSERT INTO Users
                            (login, password)
	                        VALUES('".$login."' , '".$password."')";
                    $result = $this->model->getQuery($sql);
                    if($result){
                        //$this->view->message('Success', 'You have been registered successfully! Please, sign in!');
                        $id = $this->model->getRow('SELECT id FROM Users WHERE login = "'.$login.'"');
                        $this->model->getQuery("INSERT INTO statistic 
                                              (user_id) VALUES('".$id['0']['id']."') ");
                        $this->view->location('login');
                    }
                }else{
                    $this->view->message('RegistrationError', 'You are already registered!');
                }
            }else {
                $this->view->message('LogicError', 'Fill all fields!');
            }
        }
    }

}