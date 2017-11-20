<?php

namespace application\view;

class ApplicationView extends \mf\view\AbstractView{
	/*
	* Constructeur
	*
	* Appelle le constructeur de la classe \mf\view\AbstractView
	*/
	public function __construct( $data ){
		parent::__construct($data);
	}
	/*
	* Méthode renderHeader
	*
	* Retourne le fragment HTML de l'entête (unique pour toutes les vues)
	*/
	private function renderHeader(){
		return "<header>
							<h1>Programme d'entrainement cérébral des Arbitres de la FIFA</h1>
						</header>";
	}
	/*
	* Méthode renderFooter
	*
	* Retourne le fragment HTML du pied de page (unique pour toutes les vues)
	*/
	private function renderFooter(){
		return "<footer>
							<a href='#'>Zone administrateur</a>
						</footer>";
	}
	/*
	* Méthode renderNav
	*
	* Retourne le fragment HTML du menu (unique pour toutes les vues)
	*/
	private function renderNav(){
		return "<nav>
							<ul>
								<li><a href='" . $this->app_root . "/index.php/examen/'>Examen</a></li>
								<li><a href='" . $this->app_root . "/index.php/simulation/'>Simulateur</a></li>
								<li><a href='" . $this->app_root . "/index.php/espace/'>Espace personnel</a></li>
								<li><a href='" . $this->app_root . "/index.php/login/'>Connexion</a></li>
							</ul>
						</nav>";
	}
	/*
	* Méthode renderSection
	*
	* Retourne le fragment HTML de la section avec l'image (unique pour toutes les vues)
	*/
	private function renderSection(){
		return "
							<section>
								<img alt='Tir au But' src='images/tiraubut.jpg' />
							</section>";
	}
	/*
	* Méthode renderHome
	*
	* Retourne le fragment HTML qui réalise la fonctionnalité afficher
	* le simulateur
	*
	*/
	private function renderHome(){
		$alert='';
		if (isset($this->data) and $this->data!=''){
			$alert = '<div class="alerte-' . $this->data[0] . '">' . $this->data[1] . '</div>';
		}
		$chaine=$alert;
		$chaine.="
							<section>
								<img alt='Tir au But' src='images/tiraubut.jpg' />
							</section>
							<aside>
								<div id='historique'>
									<h2>Historique de partie</h2>
									<table>
										<tr>
											<th>Equipe 1</th>
											<th>Equipe 2</th>
										</tr>";
		//A implémenter: Boucle pour ligne tableau
		$chaine.="		</table>
								</div>";
		$chaine.=$this->renderBouton();
		$chaine.="
							</aside>";
		return $chaine;
	}
	/*
	* Méthode renderUser
	*
	* Retourne le fragment HTML qui réalise la fonctionnalité afficher
	* la page de modification des informations utilisateurs
	*
	*/

	private function renderSignUp() {
		$alert = '';

		if (isset($this->data))
			$alert = '<div class="alerte-' . $this->data[0] . '">' . $this->data[1] . '</div>';

		$retour = '
				<section id="sign_up">
						<article>
								' . $alert . '
								<form action="' . $this->app_root . '/index.php/check_signup/" method=post>
										<label for="login">login *</label><input type="text" id="login" name="login" placeholder="login" required>
										<label for="num_arbitre">Numéro Arbitre *</label><input type="text" id="num_arbitre" name="num_arbitre" placeholder="num_arbitre" required>
										<label for="email">Mail *</label><input type="text" id="email" name="email" placeholder="Email" required>
										<label for="password">Mot de passe *</label><input type="password" id="password" name="password" required>
										<label for="password_verify">Confirmation du mot de passe *</label><input type="password" id="password_verify" name="password_verify" required>
										<input type="submit" value="S\'inscrire" />
										<p id="obligatoire">Les champs marqué d\'un * sont obligatoire</p>
								</form>
						</article>
				</section>

				';
		return $retour;
	}
	/*chaine
	* Méthode renderConnect
	*
	* Retourne le fragment HTML qui réalise la fonctionnalité afficher
	* la page de connexion et d'inscription
	*
	*/
	private function renderLogin() {
		$alert = '';
		if (isset ( $this->data ))
			$alert = '<div class="alerte-danger">' . $this->data . '</div>';

		$retour = '
				<section id="login">
						<article>
								' . $alert . '
								<form action="' . $this->app_root . '/index.php/check_login/" method=post>
										<label for="email">Mail</label><input type="text" id="email" name="email" placeholder="Email" required>
										<label for="password">Mot de passe</label><input type="password" id="password" name="password" placeholder="Mot de passe" required>
										<input type="submit" value="Connexion" />
								</form>
						</article>
				</section>

				';

				return $retour;
		}

	private function renderUser(){

		return $chaine;
	}
	/*style
	* Méthode renderBouton
	*	Nav
	* Retourne le fragment HTML qui réalise la fonctionnalité afficher
	* les boutons Poursuivre/stop/démarrer grisé ou non
	*
	*/
	private function renderBouton(){
		$chaine = '
								<div id="ButtonZone">
									<a href="#">Poursuivre</a>
									<a href="#">Stop</a>
								</div>
		';
		return $chaine;
	}

	/* Méthode renderBody
	*
	* Retourne la framgment HTML de la balise <body> elle est appelée
	* par la méthode héritée render.
	*
	* En fonction du selecteur (un string) passé en paramètre, elle remplit les
	* blocs avec le résultats des différentes méthodes définit plus
	* haut
	*
	*/
	protected function renderBody($selector=null){

	$header = $this->renderHeader();
	$nav = $this->renderNav();
	$footer = $this->renderFooter();
	$script_name = $this->script_name;

	switch($selector){
		case 'home':{$index=$this->renderHome();break;};
		case 'user':{$index=$this->renderUser();break;};
		case 'login':{$index=$this->renderLogin();$index.=$this->renderSignUp();break;};
		default:{$index=$this->renderHome();break;};
	}

	$html = <<<EOT
					${header}
						${nav}
						<div class='body'>
							${index}
						</div>
						${footer}
EOT;

	return  $html;

	}
}
