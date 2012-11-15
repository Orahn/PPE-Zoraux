<?php

class Zoraux_Modeles_Passage extends MVC_Modele {
    
    protected $_table = 'passage';
    protected $_modeleEnregistrement = 'Zoraux_Modeles_PassageEnregistrement';
    
    /**
     * Retourne un enregistrement vierge de la table passage
     * @return type
     */
    function newPassage(){
        $passage = $this->newEnregistrement();
        return $passage;
    }
    
}