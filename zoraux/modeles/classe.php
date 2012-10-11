<?php

class Zoraux_Modeles_Classe extends MVC_Modele {
    
    protected $_table='classe';
    protected $_modeleEnregistrement='Zoraux_Modeles_ClasseEnregistrement';

    /**
     *Création d'une nouvelle classe
     * @return le contenu d'une classe par defaut
     */
    function newClasse(){
        $classe = new Zoraux_Modeles_ClasseEnregistrement();
        $classe->id=null;
        $classe->libelle='';
        return $classe;
    }
}
