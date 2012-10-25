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
    
    function getEpreuves(){
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        $epreuves=$tableEpreuves->where('classe_id=?',array($this->id));
        return $epreuves;
    }
}