<?php

class Zoraux_Controleurs_Accueil {

    public $vue;
    
    /**
     * Permet de récupérer les informations de l'utilisateur
     */
    private function informations(){
        if(isset($_SESSION['rang'])){
            if($_SESSION['rang']=='eleve'){
                $tableEleves = new Zoraux_Modeles_Eleve();
                $eleve = $tableEleves->get($_SESSION['id']);
                $classe = $eleve->getClasse();
                $epreuves = $classe->getEpreuves();
                $passages = $eleve->getPassages();
                $this->vue->utilisateur = $eleve;
                $this->vue->classe = $classe;
                $this->vue->epreuves = $epreuves;
                $this->vue->passages = $passages;
                $this->vue->rang = $_SESSION['rang'];
            }elseif($_SESSION['rang']=='professeur' OR 'administrateur'){
                $tableMembreJurys = new Zoraux_Modeles_MembreJury();
                $membreJury = $tableMembreJurys->get($_SESSION['id']);
                $this->vue->utilisateur = $membreJury;
                $this->vue->rang = $_SESSION['rang'];
            }
        }
    }
    
    /*
     * Permet de charger la page principale
     */
    function principale(){
        $this->vue->titre='Page principale';
        $this->informations();
    }
    
    /**
     * Permet de charger la vue du calendrier des épreuves
     */
    function calendrier(){
        $this->vue->titre='Calendrier des épreuves';
        $this->informations();
    }
    
    /**
     * Permet de charger la vue des informations du compte
     */
    function monCompte(){
        $this->vue->titre = 'Mon compte';
        $this->informations();
    }
    /**
     * Permet de charger la page de modification du aPropos.
     */
    function aPropos(){
        $this->vue->titre = 'A Propos';
        $this->informations();
    }
}
