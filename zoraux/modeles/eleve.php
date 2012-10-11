<?php

class Zoraux_Modeles_Eleve extends MVC_Modele {
    protected $_table='eleve';
    protected $_modeleEnregistrement='Zoraux_Modeles_EleveEnregistrement';

    function newEleve(){
        $eleve = new Zoraux_Modeles_EleveEnregistrement();
        $eleve->id=null;
        $eleve->nom='';
        $eleve->prenom='';
        $eleve->login='';
        $eleve->password='';
        $eleve->adresseRue='';
        $eleve->adresseVille='';
        $eleve->adresseCP='';
        $eleve->email='';
        $eleve->tiersTemps='0';
        return $eleve;
    }
}
