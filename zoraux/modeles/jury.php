<?php

class Zoraux_Modeles_Jury extends MVC_Modele {
    protected $_table = 'jury';
    protected $_modeleEnregistrement='Zoraux_Modeles_JuryEnregistrement';

    /**
     * Cree un nouveau jury dont les champs sont vides, afin de simuler une modification dans le formulaire
     * @return Zoraux_Modeles_JuryEnregistrement : Nouveau jury vide cree
     */
    function newJury(){
        $jury = $this->newEnregistrement();
        return $jury;
    }
}