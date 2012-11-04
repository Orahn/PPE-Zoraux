<?php

class Zoraux_Modeles_MembreJuryEpreuve extends MVC_Modele {
    protected $_table = 'membreJury_epreuve';
    protected $_modeleEnregistrement='Zoraux_Modeles_MembreJuryEpreuveEnregistrement';

    /**
     * Cree un nouveau couple membreJury-epreuve dont les champs sont vides, afin de simuler une modification dans le formulaire
     * @return Zoraux_Modeles_MembreJuryEpreuveEnregistrement
     */
    function newMembreJuryEpreuve(){
        $membreJuryEpreuve = $this->newEnregistrement();
        return $membreJuryEpreuve;
    }
    /**
     * Recupere la liste des epreuves
     */
    function listeEpreuves(){
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        $epreuves=$tableEpreuves->listeEpreuves();
        $this->vue->epreuves=$epreuves;
    }
    /**
     * Recupere la liste des membres du jury
     */
    function listeMembreJury(){
        $tableMembresJury=new Zoraux_Modeles_MembreJury();
        $membresJury=$tableMembresJury->listeMembresJury();
        $this->vue->membresJury=$membresJury;
    }
}