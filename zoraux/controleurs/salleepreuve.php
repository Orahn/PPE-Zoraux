<?php

class Zoraux_Controleurs_SalleEpreuve {
    
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
            }elseif($_SESSION['rang']=='professeur' || $_SESSION['rang']=='administrateur'){
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
    function formSalleEpreuve(){
        $this->vue->titre = 'Affecter des salles à une épreuve';
        $tableSallesEpreuve=new Zoraux_Modeles_SalleEpreuve();
        $salleEpreuve=$tableSallesEpreuve->newSalleEpreuve();
        $this->vue->salleEpreuve=$salleEpreuve;
        
        $tableSalles=new Zoraux_Modeles_Salle();
        $this->vue->salles=$tableSalles->liste();
        
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        $this->vue->epreuves=$tableEpreuves->liste();
        
        $this->informations();
    }
    
    /**
     * Forme un enregistrement d'apres la saisie du formulaire
     */
    function enregistrerSalleEpreuve(){
        $this->vue->titre='';
        $this->informations();
        $tableSalles=new Zoraux_Modeles_SalleEpreuve();
        $tableSalles->supprimerSalleEpreuve($_POST['epreuve_id']);
        foreach($_POST['salle_id'] as $salle_id){
            $salle=$tableSalles->newSalleEpreuve();
            $salle->epreuve_id=$_POST['epreuve_id'];
            $salle->salle_id=$salle_id;
            $salle->enregistrer();
        }
    }
}