<?php

class Zoraux_Controleurs_Jury {
    
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
     * Enregistre les jurys en fonction du nombre de salle affectee a une epreuve
     */
    function enregistrerJury(){
        $this->vue->titre='';
        $tableSalle = new Zoraux_Modeles_SalleEpreuve();
        $salles = $tableSalle->where('epreuve_id=?',array($_GET['id']));
        
        $tableMembresJuryEpreuve = new Zoraux_Modeles_MembreJuryEpreuve();
        $membresJury = $tableMembresJuryEpreuve->where('epreuve_id=?',array($_GET['id']));
        
        $membreJuryID = array();
        foreach($membresJury as $membreJury){
            $membreJuryID[] = $membreJury->membreJury_id;
        }
        $tableMembreJuryID = implode(',',$membreJuryID);        
        
        $tableMembresJury = new Zoraux_Modeles_MembreJury();
        $professeurs = $tableMembresJury->where('id IN ('.$tableMembreJuryID.') AND professeur=?',array(1));
        $professionnels = $tableMembresJury->where('id IN ('.$tableMembreJuryID.') AND professionnel=?',array('1'));
        $tableJury=new Zoraux_Modeles_Jury();
        $idJury=0;
        
        foreach($professeurs as $professeur){
            $idJury+=1;
            
            $jury=$tableJury->newJury();
            $jury->id_jury=$idJury;
            $jury->acteur_id=$professeur->id;
            $jury->epreuve_id=$_GET['id'];
            $jury->enregistrer();
            
            if($idJury==sizeof($salles)){
                $idJury=0;
            }
        }
        $idJury=0;
        foreach($professionnels as $professionnel){
            $idJury+=1;
            
            $jury=$tableJury->newJury();
            $jury->id_jury=$idJury;
            $jury->acteur_id=$professionnel->id;
            $jury->epreuve_id=$_GET['id'];
            $jury->enregistrer();
            
            if($idJury==sizeof($salles)){
                $idJury=0;
            }
        }
        $this->informations();
    }
    
    function afficherJury(){
        $tableJurys = new Zoraux_Modeles_Jury;
        $this->vue->jurys = $tableJurys->liste();
        
        
    }
}
