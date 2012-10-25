<?php

class Zoraux_Controleurs_Eleves {
    
     /**
     * Formulaire de saisie d'un élève
     */
    function formEleve(){
        $tableEleves=new Zoraux_Modeles_Eleve();
        if(isset($_GET['id'])){
            $eleve=$tableEleves->get($_GET['id']);
        }else{
            $eleve=$tableEleves->newEleve();
        }
        $this->vue->eleve=$eleve;
    }
    
    /**
     * Enregistrement d'un nouvel élève 
     */
    function enregistrerEleve(){
        $tableEleves=new Zoraux_Modeles_Eleve();
        if($_POST['id']==''){
            $eleve=$tableEleves->newEleve();
        }else{
            $eleve=$tableEleves->get($_POST['id']);
        }
        if ($_POST['nom']!= '' && $_POST['prenom']!='' && $_POST['login']!='' && $_POST['password']!='' && $_POST['adresseRue']!='' && $_POST['adresseVille']!='' && $_POST['adresseCP']!='' && $_POST['email']!='' && $_POST['tiersTemps']!='') {
            $eleve->nom=$_POST['nom'];
            $eleve->prenom=$_POST['prenom'];
            $eleve->login=$_POST['login'];
            $eleve->password=$_POST['password'];
            $eleve->adresseRue=$_POST['adresseRue'];
            $eleve->adresseVille=$_POST['adresseVille'];
            $eleve->adresseCP=$_POST['adresseCP'];
            $eleve->email=$_POST['email'];
            $eleve->tiersTemps=$_POST['tiersTemps'];
            $eleve->enregistrer();
        } else {
            header('Location: ../');
        }
    }
}
