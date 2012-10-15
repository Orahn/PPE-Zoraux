<?php

class Zoraux_Modeles_EpreuveEnregistrement extends MVC_ModeleEnregistrement  {
    protected $_table='epreuve';
    /**
     * Retourne un enregistrement de la table classe selon la valeur de la cle etrangere de la table epreuve passe en parametre dans get()
     * @return type : enregistrement (objet) de la table classe
     */
    function getClasse(){
        $tableClasses=new Zoraux_Modeles_Classe();
        $classe=$tableClasses->get($this->classe_id);
        return $classe;
        
    }
    /**
     * Recupere la liste des epreuves passees par une classe dont l'id est passe en parametre par la methode GET
     */
    function listeEpreuvesClasse(){
        $tableClasses=new Zoraux_Modeles_Classe();
        $id=$_GET['id'];
        $classe=$tableClasses->get($id);
        $this->vue->classe=$classe;
        $tableEpreuves=new Zoraux_Modeles_Epreuve();
        $epreuves=$tableEpreuves->where('classe_id=?',array($id));
        $this->vue->epreuves=$epreuves;
    }
}