<?php

class Zoraux_Modeles_Epreuve extends MVC_Modele {
    protected $_table = 'epreuve';
    protected $_modeleEnregistrement='Zoraux_Modeles_EpreuveEnregistrement';

    /**
     * Cree une nouvelle epreuve dont les champs sont vides, afin de simuler une modification dans le formulaire
     * @return Zoraux_Modeles_EpreuveEnregistrement : Nouvel epreuve vide cree
     */
    function newEpreuve(){
        $epreuve = $this->newEnregistrement();
        /*$epreuve = new Zoraux_Modeles_EpreuveEnregistrement();
        $epreuve->id=null;
        $epreuve->libelle=null;
        $epreuve->dureeLibreAvant=null;
        $epreuve->dureePassage=null;
        $epreuve->dureePreparation=null;
        $epreuve->classe_id=null;*/
        return $epreuve;
    }
}