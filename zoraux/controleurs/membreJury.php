<?php

class Zoraux_Controleurs_MembreJury {
    /**
     * Forme un membre du jury selon s'il s'agit d'un nouveau membre du jury ou d'un membre du jury existante
     * (Sert a remplir les champs d'un formulaire, sans devoir faire deux formulaires differents pour une edition ou un ajout)
     */
    function formMembreJury(){
        $tableMembreJurys=new Zoraux_Modeles_MembreJury();
        if(isset($_GET['id'])){
            //Si l'id est recuperable depuis la methode GET, il s'agit d'une edition d'un membre du jury
            //Il faut alors recuperer l'enregistrement correspondant
            $membreJury=$tableMembreJurys->get($_GET['id']);
        }else{
            //Sinon, c'est qu'il s'agit d'un nouveau membre du jury
            $membreJury=$tableMembreJurys->newMembreJury();
        }
        $this->vue->membreJury=$membreJury;
    }
    /**
     * Forme un membre du jury d'apres la saisie du formulaire
     */
    function enregistrerMembreJury(){
        $tableMembreJurys=new Zoraux_Modeles_MembreJury();
        if($_POST['id']==''){
            //Si l'id est vide, c'est une nouvelle membreJury
            $membreJury=$tableMembreJurys->newMembreJury();
        }else{
            //Si l'id n'est pas vide, il s'agit d'une edition d'membreJury
            $membreJury=$tableMembreJurys->get($_POST['id']);
        }
        $membreJury->nom=$_POST['nom'];
        $membreJury->prenom=$_POST['prenom'];
        $membreJury->mail=$_POST['mail'];
        $membreJury->numTelephone=$_POST['numTelephone'];
        $membreJury->professeur=$_POST['professeur'];
        $membreJury->professionnel=$_POST['professionnel'];
        $membreJury->autre=$_POST['autre'];
        $membreJury->classe_id=$_POST['classe_id'];
        $membreJury->enregistrer();
    }
    /**
     * Supprime un membre du jury selon l'id transmis en GET
     */
    function supprimerMembreJury(){
        $tableMembreJurys=new Zoraux_Modeles_MembreJury();
        if(isset($_GET['id'])){
            //Si l'id n'est pas transmis par la methode GET, on considere qu'une erreur est survenue, alors on ne fait rien
            //Sinon, on peut supprimer l'membreJury souhaitee
            $membreJury=$tableMembreJurys->get($_GET['id']);
            $membreJury->supprimer();
        }
    }
}
