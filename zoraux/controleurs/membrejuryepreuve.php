<?php

class Zoraux_Controleurs_MembreJuryEpreuve {
    
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
            }elseif($_SESSION['rang']=='professeur'){
                $tableMembreJurys = new Zoraux_Modeles_MembreJury();
                $membreJury = $tableMembreJurys->get($_SESSION['id']);
                $this->vue->utilisateur = $membreJury;
                $this->vue->rang = $_SESSION['rang'];
            }
        }
    }
    
    /**
     * Forme un enregistrement selon s'il s'agit d'un nouveau ou d'une modification
     * (Sert a remplir les champs d'un formulaire, sans devoir faire deux formulaires differents pour une edition ou un ajout)
     */
    function formMembreJuryEpreuve(){
        $this->vue->titre = 'Affecter des membres du jury à une épreuve';
        $tableMembresJuryEpreuve=new Zoraux_Modeles_MembreJuryEpreuve();
        $membreJuryEpreuve=$tableMembresJuryEpreuve->newMembreJuryEpreuve();
        $this->vue->membreJuryEpreuve=$membreJuryEpreuve;
        
        $tableMembresJury=new Zoraux_Modeles_MembreJury();
        $this->vue->professeurs=$tableMembresJury->where('professeur=?',array('1'));
        $this->vue->professionnels=$tableMembresJury->where('professionnel=?',array('1'));
        
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        $this->vue->epreuves=$tableEpreuves->liste();
        
        $this->informations();
    }
    
    /**
     * Forme un enregistrement d'apres la saisie du formulaire
     */
    function enregistrerMembreJuryEpreuve(){
        $this->vue->titre='';
        $this->informations();
        $tableMembresJuryEpreuve=new Zoraux_Modeles_MembreJuryEpreuve();
        $tableMembresJuryEpreuve->supprimerMembreJuryEpreuve($_POST['epreuve_id']);
        foreach($_POST['professeur_id'] as $membreJury_id){
            $membreJuryEpreuve=$tableMembresJuryEpreuve->newMembreJuryEpreuve();
            $membreJuryEpreuve->epreuve_id=$_POST['epreuve_id'];
            $membreJuryEpreuve->membreJury_id=$membreJury_id;
            $membreJuryEpreuve->enregistrer();
        }
        foreach($_POST['professionnel_id'] as $membreJury_id){
            $membreJuryEpreuve=$tableMembresJuryEpreuve->newMembreJuryEpreuve();
            $membreJuryEpreuve->epreuve_id=$_POST['epreuve_id'];
            $membreJuryEpreuve->membreJury_id=$membreJury_id;
            $membreJuryEpreuve->enregistrer();
        }
    }
}