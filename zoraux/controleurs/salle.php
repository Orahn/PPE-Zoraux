<?php

class Zoraux_Controleurs_Salle {
    /**
     * Forme une salle selon s'il s'agit d'une nouvelle salle ou d'une salle existante
     * (Sert a remplir les champs d'un formulaire, sans devoir faire deux formulaires differents pour une edition ou un ajout)
     */
    function formSalle(){
        $tableSalles=new Zoraux_Modeles_Salle();
        if(isset($_GET['id'])){
            //Si l'id est recuperable depuis la methode GET, il s'agit d'une edition de salle
            //Il faut alors recuperer l'enregistrement correspondant
            $salle=$tableSalles->get($_GET['id']);
        }else{
            //Sinon, c'est qu'il s'agit d'un nouvel salle
            $salle=$tableSalles->newSalle();
        }
        $this->vue->salle=$salle;
    }
    /**
     * Forme un salle d'apres la saisie du formulaire
     */
    function enregistrerSalle(){
        $tableSalles=new Zoraux_Modeles_Salle();
        if($_POST['id']==''){
            //Si l'id est vide, c'est un nouvel salle
            $salle=$tableSalles->newSalle();
        }else{
            //Si l'id n'est pas vide, il s'agit d'une edition d'salle
            $salle=$tableSalles->get($_POST['id']);
        }
        $salle->libelle=$_POST['libelle'];
        $salle->enregistrer();
    }
    /**
     * Supprime un salle selon l'id transmis en GET
     */
    function supprimerSalle(){
        $tableSalles=new Zoraux_Modeles_Salle();
        if(isset($_GET['id'])){
            //Si l'id n'est pas transmis par la methode GET, on considere qu'une erreur est survenue
            //Alors on ne fait rien
            $salle=$tableSalles->get($_GET['id']);
            $salle->supprimer();
        }
    }
}