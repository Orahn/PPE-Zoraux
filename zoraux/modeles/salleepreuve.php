<?php

class Zoraux_Modeles_SalleEpreuve extends MVC_Modele {
    protected $_table = 'salle_epreuve';
    protected $_modeleEnregistrement='Zoraux_Modeles_SalleEpreuveEnregistrement';

    /**
     * Cree une nouvelle salle dont les champs sont vides, afin de simuler une modification dans le formulaire
     * @return Zoraux_Modeles_SalleEnregistrement : Nouvelle salle vide cree
     */
    function newSalleEpreuve(){
        $salle = $this->newEnregistrement();
        return $salle;
    }
    
    /**
     * Supprime tous les enregistrements où les salles sont affectees a une epreuve dont l'id est passe en parametre
     */
    function supprimerSalleEpreuve($epreuve_id){
        $salles=$this->where('epreuve_id=?',array($epreuve_id));
        foreach($salles as $salle){
            $salle->supprimer();
        }
    }
}