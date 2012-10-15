<?php

class Zoraux_Controleurs_Classe {
    
<<<<<<< HEAD
     /**
     * Formulaire de saisie d'une classe
     */
    function formClasse(){
        $tableClasses=new Blog_Modeles_Classe();
        if(isset($_GET['id'])){
            $classe=$tableClasses->get($_GET['id']);
        }else{
            $classe=$tableClasses->newClasse();
        }
        $this->vue->classe=$classe;
    }
    
    /**
     * Enregistrement d'une nouvelle classe
     */
    function enregistrerClasse(){
        $tableClasses=new Blog_Modeles_Classe();
        if($_POST['id']==''){
            $classe=$tableClasses->newClasse();
        }else{
            $classe=$tableClasses->get($_POST['id']);
        }
        if ($_POST['id']!= '' && $_POST['libelle']!='') {
            $classe->id=$_POST['id'];
            $classe->libelle=$_POST['libelle'];
            $classe->enregistrer();
        } else {
            header('Location: ../');
=======
    function listeProfesseur(){
        $tableProfesseurs=new Zoraux_Modeles_MembreJury();
        $id=$_GET['id'];
        $professeur=$tableProfesseurs->get($id);
        $this->vue->auteur=$professeur;
        $tableClasses=new Zoraux_Modeles_Classe();
        $classes=$tableClasses->where('id=?',array($id));
        $this->vue->articles=$classes;
    }
    
    /**
     * Permet de supprimer une classe de la base de donnees
     */
    
    function supprimerClasse(){
        $tableClasses=new Zoraux_Modeles_Classe();
        if(isset($_GET['id'])){ //Si l'id existe dans l'URL
            $classe=$tableClasses->get($_GET['id']); //On recupere l'article correspondant à cet id dans la table article
            $classe->supprimer(); //On fait appel à la methode supprimer sur cet article
>>>>>>> 2aebf3fba90838e58212563e6c4d1b126ee1a975
        }
    }
}
