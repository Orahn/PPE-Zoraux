<?php

class Zoraux_Modeles_Classe extends MVC_Modele {
<<<<<<< HEAD
    
    protected $_table='classe';
    protected $_modeleEnregistrement='Zoraux_Modeles_ClasseEnregistrement';

    /**
     *Création d'une nouvelle classe
     * @return le contenu d'une classe par defaut
     */
    function newClasse(){
        $classe = new Zoraux_Modeles_ClasseEnregistrement();
        $classe->id=null;
        $classe->libelle='';
        return $classe;
    }
}
=======
    protected $_table='classe';
    protected $_modeleEnregistrement='Zoraux_Modeles_ClasseEnregistrement';
}
>>>>>>> 2aebf3fba90838e58212563e6c4d1b126ee1a975
