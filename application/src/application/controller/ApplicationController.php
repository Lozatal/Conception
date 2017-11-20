<?php

namespace application\controller;

class ApplicationController extends \mf\control\AbstractController {

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


  /* Méthode viewHome :
   *
   * Réalise la fonctionnalité : afficher la liste de Tweet
   *
   */

  public function viewHome(){
    $vue = new \application\view\ApplicationView('');
    return $vue->render('home');
  }
}
