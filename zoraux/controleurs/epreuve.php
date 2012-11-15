<?php

class Zoraux_Controleurs_Epreuve {
    
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
     * Forme une epreuve selon s'il s'agit d'une nouvelle epreuve ou d'une epreuve existante
     * (Sert a remplir les champs d'un formulaire, sans devoir faire deux formulaires differents pour une edition ou un ajout)
     */
    function formEpreuve(){
        $this->vue->titre = 'Enregistrer une épreuve';
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        if(isset($_GET['id'])){
            //Si l'id est recuperable depuis la methode GET, il s'agit d'une edition d'epreuve
            //Il faut alors recuperer l'enregistrement correspondant
            $epreuve=$tableEpreuves->get($_GET['id']);
        }else{
            //Sinon, c'est qu'il s'agit d'une nouvelle epreuve
            $epreuve=$tableEpreuves->newEpreuve();
        }
        $this->vue->epreuve=$epreuve;
        
        $tableClasses=new Zoraux_Modeles_Classe();
        $this->vue->classes=$tableClasses->liste();
        
        $this->informations();
    }
    
    /**
     * Permet de charger la vue qui permet à un élève de s'inscrire à une épreuve
     */
    function formInscriptionEpreuve(){
        $this->vue->titre = 'Inscription à une épreuve';
        $this->informations();
    }
    
    /**
     * Forme une epreuve d'apres la saisie du formulaire
     */
    function enregistrerEpreuve(){
        $this->vue->titre='';    
        $this->informations();
        
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        if(empty($_GET['id'])){
            //Si l'id est vide, c'est une nouvelle epreuve
            $epreuve=$tableEpreuves->newEpreuve();
        }else{
            //Si l'id n'est pas vide, il s'agit d'une edition d'epreuve
            $epreuve=$tableEpreuves->get($_GET['id']);
        }
        $epreuve->libelle=$_POST['libelle'];
        $epreuve->dureeLibreAvant=$_POST['dureeLibreAvant'];
        $epreuve->dureePassage=$_POST['dureePassage'];
        $epreuve->dureePreparation=$_POST['dureePreparation'];
        $epreuve->classe_id=$_POST['classe_id'];
        $epreuve->enregistrer();
    }
    /**
     * Supprime une epreuve selon l'id transmis en GET
     */
    function supprimerEpreuve(){
        $this->vue->titre = 'Supprimer une épreuve';
        $this->informations();
        
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        if(isset($_GET['id'])){
            //Si l'id n'est pas transmis par la methode GET, on considere qu'une erreur est survenue, alors on ne fait rien
            //Sinon, on peut supprimer l'epreuve souhaitee
            $epreuve=$tableEpreuves->get($_GET['id']);
            $epreuve->supprimer();
        }
    }
    
    function listeEpreuvesClasse(){
        $this->vue->titre = 'Liste des épreuves';
        $this->informations();
    }
}