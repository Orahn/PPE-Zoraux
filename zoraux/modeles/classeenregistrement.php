<?php

class Zoraux_Modeles_ClasseEnregistrement extends MVC_ModeleEnregistrement{
    protected $_table='classe';
    
     /**
     * Permet de recuperer les eleves d'une classe
     * @return array
     */
    
    function getEleve(){
        $tableEleves=new Zoraux_Modeles_Eleve();
        $eleve=$tableEleves->get($this->classe_id);
        return $eleve;
    }
    
    /**
     * Permet de recuperer les epreuves d'une classe
     * @return array
     */
    
    function getEpreuve(){
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        $epreuve=$tableEpreuves->get($this->classe_id);
        return $epreuve;
    }
    
    /**
     * Liste les classes par professeurs
     */
    
    function listeProfesseur(){
        $tableProfesseurs=new Zoraux_Modeles_MembreJury();
        $id=$_GET['id'];
        $professeur=$tableProfesseurs->get($id);
        $this->vue->auteur=$professeur;
        $tableClasses=new Zoraux_Modeles_Classe();
        $classes=$tableClasses->where('id=?',array($id));
        $this->vue->articles=$classes;
    }
    
}