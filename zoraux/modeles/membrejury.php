<?php

class Zoraux_Modeles_MembreJury extends MVC_Modele {
    protected $_table = 'membreJury';
    protected $_modeleEnregistrement='Zoraux_Modeles_MembreJuryEnregistrement';

    /**
     * Cree un nouveau membre du jury dont les champs sont vides, afin de simuler une modification dans le formulaire
     * @return Zoraux_Modeles_MembreJuryEnregistrement : Nouveau membre du jury vide cree
     */
    function newMembreJury(){
        $membreJury = $this->newEnregistrement();
        return $membreJury;
    }
}