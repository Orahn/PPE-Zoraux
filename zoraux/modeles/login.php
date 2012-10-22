<?php

class Zoraux_Modeles_Login extends MVC_Modele {
    protected $_table = 'login';
    protected $_modeleEnregistrement='Zoraux_Modeles_LoginEnregistrement';

    /**
     * Création d'un nouveau login vierge
     * @return Zoraux_Modeles_EpreuveEnregistrement
     */
    function newLogin(){
        $login = $this->newEnregistrement();
        return $login;
    }
}
