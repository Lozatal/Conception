<?php

namespace application\controller;

class SimulationController extends \mf\control\AbstractController {

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
   public function examen(){
     return $this->simulation(1);
   }
  public function simulation($simu=null){
    $vue = new \application\view\ApplicationView('');
    return $vue->render('home');
  }
}
