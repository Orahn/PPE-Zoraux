<?php

class Zoraux_Controleurs_Passage {
    
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
            }elseif($_SESSION['rang']=='professeur'OR 'administrateur'){
                $tableMembreJurys = new Zoraux_Modeles_MembreJury();
                $membreJury = $tableMembreJurys->get($_SESSION['id']);
                $this->vue->utilisateur = $membreJury;
                $this->vue->rang = $_SESSION['rang'];
            }
        }
    }
    
    /**
     * Permet d'enregistrer une inscription à une épreuve créer un passage qui sera modifié par la suite
     */
    function enregistrerInscription(){
        $this->vue->titre='';
        $this->informations();
        $tablePassages=new Zoraux_Modeles_Passage();
        if(empty($_GET['id'])){
            //Si l'id est vide, c'est un nouveau passage
            $passage=$tablePassages->newPassage();
        }else{
            //Si l'id n'est pas vide, il s'agit d'une edition de passage
            $passage=$tablePassages->get($_GET['id']);
        }
        @$passageExiste=$tablePassages->where('epreuve_id=? AND eleve_id=?',array($_POST['epreuve_id'],$_POST['eleve_id']));
        if(empty($passageExiste) && !$tablePassages->exists($passageExiste->id)){
            $passage->epreuve_id=$_POST['epreuve_id'];
            $passage->eleve_id=$_POST['eleve_id'];
            $passage->enregistrer();
        } 
    }
    
    /**
     * Permet d'enregistrer un passage
     */
    function enregistrerPassage(){
        $this->vue->titre='';
        $this->informations();
        $tablePassages=new Zoraux_Modeles_Passage();
        if(empty($_GET['id'])){
            //Si l'id est vide, c'est un nouveau passage
            $passage=$tablePassages->newPassage();
        }else{
            //Si l'id n'est pas vide, il s'agit d'une edition de passage
            $passage=$tablePassages->get($_GET['id']);
        }
        $passage->date=$_POST['date'];
        $passage->heurePassage=$_POST['heurePassage'];
        $passage->epreuve_id=$_POST['epreuve_id'];
        $passage->eleve_id=$_POST['eleve_id'];
        $passage->jury_id=$_POST['jury_id'];
        $passage->salle_id=$_POST['salle_id'];
        $passage->enregistrer();
    }
    
    /**
     * Supprime le passage
     */
    function supprimerPassage(){
        $this->vue->titre='';
        $this->informations();
        $tablePassages = new Zoraux_Modeles_Passage();
        if(isset($_GET['id'])){
            $passage = $tablePassages->get($_GET['id']);
            $passage->supprimer();
        }
    }
}
