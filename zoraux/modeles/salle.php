<?php

class Zoraux_Modeles_Salle extends MVC_Modele {
    protected $_table = 'salle';
    protected $_modeleEnregistrement='Zoraux_Modeles_SalleEnregistrement';

    /**
     * Cree une nouvelle salle dont les champs sont vides, afin de simuler une modification dans le formulaire
     * @return Zoraux_Modeles_SalleEnregistrement : Nouvelle salle vide cree
     */
    function newSalle(){
        $salle = $this->newEnregistrement();
        return $salle;
    }
}