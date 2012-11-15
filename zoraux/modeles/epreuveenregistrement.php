<?php

class Zoraux_Modeles_EpreuveEnregistrement extends MVC_ModeleEnregistrement {

    protected $_table = 'epreuve';

    /**
     * Retourne un enregistrement de la table classe selon la valeur de la cle etrangere de la table epreuve passe en parametre dans get()
     * @return type : enregistrement (objet) de la table classe
     */
    function getClasse() {
        $tableClasses = new Zoraux_Modeles_Classe();
        $classe = $tableClasses->get($this->classe_id);
        return $classe;
    }

    /**
     * Retourne les membres de jury affectés à l'épreuve
     * @return type
     */
    function getMembresJury() {
        $tableMJ = new Zoraux_Modeles_MembreJury();
        $tableMJE = new Zoraux_Modeles_MembreJuryEpreuve();
        $membresJury = $tableMJE->where('epreuve_id=?', array($this->id));
        
        $membresAffectes = array();
        foreach ($membresJury as $m) {
            $membre = $tableMJ->get($m->membreJury_id);
            $membresAffectes[] = $membre;
        }
        return $membresAffectes;
    }

    /**
     * Retourne les salles affectées à l'épreuve
     * @return type
     */
    function getSalles() {
        $tableSE = new Zoraux_Modeles_SalleEpreuve();
        $tableS = new Zoraux_Modeles_Salle();
        $salles_epreuves = $tableSE->where('epreuve_id=?', array($this->id));

        $sallesAffectees = array();
        foreach ($salles_epreuves as $s) {
            $salle = $tableS->get($s->salle_id);
            $sallesAffectees[] = $salle;
        }
        return $sallesAffectees;
    }

    /**
     * retourne les élèves qui passent une épreuve
     * @return int
     */
    function getEleves() {
        $tableEleves = new Zoraux_Modeles_EleveEnregistrement();
        $passages = $this->getPassages();
        $eleves = array();
        foreach ($passages as $p) {
            $eleves[] = $tableEleves->get($p->eleve_id);
        }
        return $eleves;
    }

    function getNbEleves() {
        return sizeof($this->getPassages());
    }

    function getPassages() {
        $tablePassages = new Zoraux_Modeles_Passage();
        return $tablePassages->where('epreuve_id=?', array($this->id));
    }

}