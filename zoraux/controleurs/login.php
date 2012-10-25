<?php
class Zoraux_Controleurs_Login {

    public $vue;
    
    /*
     * Page de login
     */
    function auth(){
        $this->vue->titre='Zoraux';
    }
    
    /**
     * Authentification de l'utilisateur
     */
    function verification(){
        $login = $_GET['login'];
        $password = $_GET['pass'];
        
        $tableLogin = new Zoraux_Modeles_Login();
        /* Le @ empêche l'affichage des erreurs en cas de login incorrect */
        @$verification = $tableLogin->whereFirst('login=? AND password=?', array($login,$password));
        /* On vérifie si l'id existe */
        if(!empty($verification) && $tableLogin->exists($verification->id)){
            $this->vue->connexion = 'ok';
            /* On vérifie si l'utilisateur est un élève ou un membre de jury */
            if($verification->eleve_id>0){
                $tableEleves = new Zoraux_Modeles_Eleve();
                $eleve = $tableEleves->get($verification->eleve_id);
                $this->vue->utilisateur = $eleve;
                $this->vue->login = $verification;
                $this->vue->rang = 'eleve';
                $_SESSION['id']=$eleve->id;
            }else{
                if($verification->membreJury_id>0){
                    $tableMembreJurys = new Zoraux_Modeles_MembreJury();
                    $membreJury = $tableMembreJurys->get($verification->membreJury_id);
                    $this->vue->utilisateur = $membreJury;
                    $this->vue->login = $verification;
                    $this->vue->rang = 'professeur';
                    $_SESSION['id']=$membreJury->id;
                }
            }
        }else{
            $this->vue->connexion = 'incorrect';
        }
    }
    
    /**
     * Déconnecte la session
     */
    function deconnexion(){
        $_SESSION=array();
    }
    
}
