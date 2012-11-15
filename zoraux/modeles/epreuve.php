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
    /**
     * Recupere la liste des epreuves passees par une classe dont l'id est passe en parametre par la methode GET
     */
    function listeEpreuvesClasse(){
        $tableClasses=new Zoraux_Modeles_Classe();
        $id=$_GET['id'];
        $classe=$tableClasses->get($id);
        $this->vue->classe=$classe;
        $epreuves=$this->where('classe_id=?',array($id));
        $this->vue->epreuves=$epreuves;
    }
}