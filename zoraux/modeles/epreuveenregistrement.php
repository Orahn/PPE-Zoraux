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
     * Retourne les membres de jury affectés à l'épreuve
     * @return type
     */
    function getMembresJury(){
        $tableMJ = new Zoraux_Modeles_MembreJury();
        $tableMJE = new Zoraux_Modeles_MembreJuryEpreuve();
        $membresJury = $tableMJE->where('epreuve_id=?',array($this->id));
        $membres = array();
        foreach($membresJury as $m){
            $membre = $tableMJ->get($m->membreJury_id);
            array_push($membres,$membre);
        }
        return $membres;
    }
    
    /**
     * Retourne les salles affectées à l'épreuve
     * @return type
     */
    function getSalles(){
        $tableSE = new Zoraux_Modeles_SalleEpreuve();
        $tableS = new Zoraux_Modeles_Salle();
        $salles = $tableSE->where('epreuve_id=?',array($this->id));
        $sallesAffectees = array();
        foreach($salles as $s){
            $salle = $tableS->get($s->id);
            array_push($sallesAffectees,$salle);
        }
        return $sallesAffectees;
    }
}