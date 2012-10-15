<?php

<<<<<<< HEAD
class Zoraux_Modeles_ClasseEnregistrement extends MVC_ModeleEnregistrement  {
    protected $_table='classe';
=======
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
>>>>>>> 2aebf3fba90838e58212563e6c4d1b126ee1a975
}