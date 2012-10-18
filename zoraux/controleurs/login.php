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
        $login = $_POST['login'];
        $password = $_POST['pass'];
        
        $tableLogin = new Zoraux_Modeles_Login();
        $verification = $tableLogin->whereFirst('login=? AND password=?', array($login,$password));
        /* On vérifie si l'id existe */
        if($tableLogin->exists($verification->id)){
            /* On vérifie si l'utilisateur est un élève ou un membre de jury */
            if($verification->eleve_id>1){
                $tableEleves = new Zoraux_Modeles_Eleve();
                $eleve = $tableEleves->get($verification->eleve_id);
                $this->vue->utilisateur = $eleve;
                $this->vue->login = $verification;
                $this->vue->rang = 'eleve';
            }else{
                if($verification->membreJury_id>1){
                    $tableMembreJurys = new Zoraux_Modeles_MembreJury();
                    $membreJury = $tableMembreJurys->get($verification->membreJury_id);
                    $this->vue->utilisateur = $membreJury;
                    $this->vue->login = $verification;
                    $this->vue->rang = 'membreJury';
                }
            }
        }
    }
    
}
