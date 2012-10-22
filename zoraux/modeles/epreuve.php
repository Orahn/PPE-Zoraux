<?php

class Zoraux_Modeles_Epreuve extends MVC_Modele {
    protected $_table = 'epreuve';
    protected $_modeleEnregistrement='Zoraux_Modeles_EpreuveEnregistrement';

    /**
     * Cree une nouvelle epreuve dont les champs sont vides, afin de simuler une modification dans le formulaire
     * @return Zoraux_Modeles_EpreuveEnregistrement : Nouvelle epreuve vide cree
     */
    function newEpreuve(){
        $epreuve = $this->newEnregistrement();
        return $epreuve;
    }
}