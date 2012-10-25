<?php

class Zoraux_Modeles_PassageEnregistrement extends MVC_ModeleEnregistrement  {
    
    protected $_table = 'passage';
    
    /**
     * Retourne la classe concernée par le passage
     * @return type
     */
    function getClasse(){
        $tableClasses=new Zoraux_Modeles_Classe();
        $classe=$tableClasses->get($this->classe_id);
        return $classe;
    }
    
    /**
     * Retourne l'épreuve concernée par le passage
     * @return type
     */
    function getEpreuve(){
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        $epreuve=$tableEpreuves->get($this->epreuve_id);
        return $epreuve;
    }
    
}