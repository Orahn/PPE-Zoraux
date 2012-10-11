<?php

class Zoraux_Controleurs_Epreuve {
        /**
     * Forme une epreuve selon s'il s'agit d'une nouvelle epreuve ou d'une epreuve existante
     * (Sert a remplir les champs d'un formulaire, sans devoir faire deux formulaires differents pour une edition ou un ajout)
     */
    function formEpreuve(){
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
    }
    /**
     * Forme une epreuve d'apres la saisie du formulaire
     */
    function enregistrerEpreuve(){
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        if($_POST['id']==''){
            //Si l'id est vide, c'est une nouvelle epreuve
            $epreuve=$tableEpreuves->newEpreuve();
        }else{
            //Si l'id n'est pas vide, il s'agit d'une edition d'epreuve
            $epreuve=$tableEpreuves->get($_POST['id']);
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
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        if(isset($_GET['id'])){
            //Si l'id n'est pas transmis par la methode GET, on considere qu'une erreur est survenue, alors on ne fait rien
            //Sinon, on peut supprimer l'epreuve souhaitee
            $epreuve=$tableEpreuves->get($_GET['id']);
            $epreuve->supprimer();
        }
    }
}