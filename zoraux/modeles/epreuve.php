<?php

class Zoraux_Modeles_Epreuve extends MVC_Modele {
    protected $_table = 'epreuve';
    protected $_modeleEnregistrement='Zoraux_Modeles_EpreuveEnregistrement';

    /**
     * Cree un nouvel epreuve dont les champs sont vides, afin de simuler une modification dans le formulaire
     * @return Zoraux_Modeles_EpreuveEnregistrement : Nouvel epreuve vide cree
     */
    function newEpreuve(){
        $epreuve = new Zoraux_Modeles_EpreuveEnregistrement();
        $epreuve->id=null;
        $epreuve->libelle=null;
        $epreuve->dureeLibre=null;
        $epreuve->dureePassage=null;
        $epreuve->dureePreparation=null;
        $epreuve->classe_id=null;
        return $epreuve;
    }
}