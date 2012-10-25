<?php

class Zoraux_Modeles_Eleve extends MVC_Modele {

    protected $_table='eleve';
    protected $_modeleEnregistrement='Zoraux_Modeles_EleveEnregistrement';

    /**
     *Création d'un nouvel eleve
     * @return le contenu d'un eleve par defaut
     */
    function newEleve(){
        $eleve = $this->newEnregistrement();
        return $eleve;
    }
}
