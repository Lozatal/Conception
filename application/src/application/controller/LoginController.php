<?php

namespace application\controller;


class LoginController extends \mf\control\AbstractController {


    /* Constructeur :
     *
     * Appelle le constructeur parent
     *
     * c.f. la classe \mf\control\AbstractController
     *
     */

    public function __construct(){
        parent::__construct();
    }

    public function signUp(){

        $v = new \application\view\ApplicationView(null);
        $v ->render('signUp');

    }

    public function checkSignup(){

        $login = $this->request->post['login'];
        $num_arbitre = $this->request->post['num_arbitre'];
        $email = $this->request->post['email'];
        $pass = $this->request->post['password'];
        $pass_verify = $this->request->post['password_verify'];

        $v = new \application\auth\ApplicationAuthentification();
        try {

            if(strlen($pass) <= 5)
            {
                throw new \mf\auth\exception\AuthentificationException('Le mot de passe doit faire au moins 5 caractères');
            }

            $v->createUser($login, $num_arbitre, $email, $pass, $pass_verify);
            $tab[]= 'success';
            $tab[]= 'Inscription réussie';
            $v = new \application\view\ApplicationView($tab);
            $v ->render('home');
        }
        catch(\mf\auth\exception\AuthentificationException $e)
        {
            $tab[]= 'danger';
            $tab[]= $e->getMessage();
            $v = new \application\view\ApplicationView($tab);
            $v ->render('home');
        }

    }

    public function login(){

        $v = new \application\view\ApplicationView(null);
        $v ->render('login');

    }

    public function checkLogin(){

        $email = $this->request->post['email'];
        $password = $this->request->post['password'];

        $v = new \application\auth\ApplicationAuthentification();
        try {
            $v->login($email, $password);
            $v = new \application\view\ApplicationView(null);
            $v ->render('home');
        }
        catch(\mf\auth\exception\AuthentificationException $e)
        {
            $v = new \application\view\ApplicationView($e->getMessage());
            $v ->render('login');
        }

    }

    public function logout(){
        $v = new \application\auth\ApplicationAuthentification();
        $v->logout();
        $v = new \application\view\ApplicationView(null);
        $v ->render('home');
    }

}
