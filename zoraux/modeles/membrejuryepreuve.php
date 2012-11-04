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
     * Supprime tous les enregistrements où les membres sont affectes a une epreuve dont l'id est passe en parametre
     */
    function supprimerMembreJuryEpreuve($epreuve_id){
        $membresJury=$this->where('epreuve_id=?',array($epreuve_id));
        foreach($membresJury as $membreJury){
            $membreJury->supprimer();
        }
    }
}