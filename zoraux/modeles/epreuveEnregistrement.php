<?php

class Zoraux_Modeles_EpreuveEnregistrement extends MVC_ModeleEnregistrement  {
    protected $_table='epreuve';
    /**
     * Retourne un enregistrement de la table classe selon la valeur de la cle etrangere de la table epreuve passe en parametre dans get()
     * @return type : enregistrement (objet) de la table classe
     */
    function classe(){
        $tableClasses=new Zoraux_Modeles_Classe();
        $classe=$tableClasses->get($this->classe_id);
        return $classe;
        
    }
}