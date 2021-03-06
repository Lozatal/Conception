<?php

namespace application\auth;

class ApplicationAuthentification extends \mf\auth\Authentification {

    /*
     * Classe TweeterAuthentification qui définie les méthodes qui dépendent
     * de l'application (liée à la manipulation du modéle User)
     *
     */

    /* niveaux d'accés de TweeterApp
     *
     * Le niveau USER correspond a un utilisateur inscrit avec un compte
     * Le niveau ADMIN est un plus haut niveau (non utilisé ici)
     *
     * Ne pas oublier le niveau NONE un utilisateur non inscrit est hérité
     * depuis AbstractAuthentification
     */
    const ACCESS_LEVEL_USER  = 100;
    const ACCESS_LEVEL_ADMIN = 200;

    /* constructeur */
    public function __construct(){
        parent::__construct();
    }

    /* La méthode createUser
     *
     *  Permet la création d'un nouvel utilisateur de l'application
     *
     *
     * @param : $username : le nom d'utilisateur choisi
     * @param : $pass : le mot de passe choisi
     * @param : $fullname : le nom complet
     * @param : $level : le niveaux d'accés (par défaut ACCESS_LEVEL_USER)
     *
     * Algorithme :
     *
     *  Si un utilisateur avec le même nom d'utilisateur existe déjà  en BD
     *     - soulever une exception
     *  Sinon
     *     - créer un nouvel modéle User avec les valeurs en paramètre
     *       ATTENTION : Le mot de passe ne doit pas être enregistré en clair.
     *
     */

    public function createUser($login, $num_arbitre, $email, $pass, $pass_verif,
                               $level=self::ACCESS_LEVEL_USER) {

        $requete = \application\model\User::where('mail', '=', $email);
        $usertest = $requete->first();

        if($usertest!=null)
        {
            throw new \mf\auth\exception\AuthentificationException('Email déjà utilisé');
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new \mf\auth\exception\AuthentificationException('Mauvais format d\'adresse email');
            echo '2';
        }
        elseif($pass != $pass_verif)
        {
            throw new \mf\auth\exception\AuthentificationException('Les deux mots de passe ne correspondent pas');
            echo '1';
        }
        else
        {
            $user = new \application\model\User();
            $user->login = $login;
            $user->num_arbitre = $num_arbitre;
            $user->mail = $email;
            $user->password = $this->hashPassword($pass);
            $user->save();
        }
    }

    /* La méthode login
     *
     * permet de connecter un utilisateur qui a fourni son nom d'utilisateur
     * et son mot de passe (depuis un formulaire de connexion)
     *
     * @param : $username : le nom d'utilisateur
     * @param : $password : le mot de passe tapé sur le formulaire
     *
     * Algorithme :
     *
     *  Récupérer l'utilisateur avec le nom d'utilisateur $username depuis la BD
     *  Si aucun de trouvé
     *      soulever une exception
     *  sinon
     *      si $password correspond au mot de passe crypté en BD
     *          charger la session de l'utilisateur
     *      sinon soulever une exception
     *
     */

    public function login($email, $password) {

        $requete = \application\model\User::where('mail', '=', $email);

        $usertest = $requete->first();

        if($usertest==null)
        {
            throw new \mf\auth\exception\AuthentificationException('Mauvaise combinaison email/password');
        }
        else
        {
            if($this->verifyPassword($password, $usertest->password))
            {
                $this->updateSession($email, self::ACCESS_LEVEL_USER);
            }
            else
            {
                throw new \mf\auth\exception\AuthentificationException('Mauvaise combinaison email/password');
            }
        }
    }

}
