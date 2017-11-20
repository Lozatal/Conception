<?php

namespace application\controller;

class EspaceController extends \mf\control\AbstractController {

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

  public function espace(){
    $vue = new \application\view\ApplicationView('');
    return $vue->render('home');
  }
}
