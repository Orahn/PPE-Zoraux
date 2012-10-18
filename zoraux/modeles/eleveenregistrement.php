<?php

class Zoraux_Modeles_EleveEnregistrement extends MVC_ModeleEnregistrement  {
    protected $_table='eleve';
    
    /**
     * Permet de récupérer la classe de l'élève
     * @return classe
     */
    function getClasse(){
        $tableClasses=new Zoraux_Modeles_ClasseEnregistrement();
        $classe=$tableClasses->get($this->classe_id);
        return $classe;
    }
}
