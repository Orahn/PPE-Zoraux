<?php

class Zoraux_Modeles_Passage extends MVC_Modele {
    
    protected $_table='passage';
    protected $_modeleEnregistrement='Zoraux_Modeles_PassageEnregistrement';

    /**
     *Création d'un nouveau passage
     * @return le contenu d'un passage par defaut
     */
    function newPassage(){
        $passage = new Zoraux_Modeles_PassageEnregistrement();
        $passage->id=null;
        $passage->date='';
        $passage->heurePassage='';
        $passage->eleve_id='';
        $passage->epreuve_id='';
        $passage->jury_id='';
        $passage->salle_id='';
        return $passage;
    }
}
