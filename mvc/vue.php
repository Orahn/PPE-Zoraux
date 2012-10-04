<?php
class MVC_Vue{
    private $_fichier;
    private $_donnees;
    /**
     * Constructeur de la vue
     * @param type $controleur
     * @param type $action
     */
    function __construct($controleur,$action){
        $this->_donnees=array();
        $controleur=explode('_',$controleur);
        unset($controleur[0]);
        unset($controleur[1]);
        $controleur=implode('_',$controleur);
        $this->_fichier=Params_Chemins::VUES
                .strtolower(str_replace('_', '/', $controleur))
                .'/'
                .strtolower($action)
                .'.php';        
    }
    /**
     * Création d'un élément clé=>valeur
     * @param type $nomAttribut
     * @param type $valeurAttribut
     */
    function __set($nomAttribut,$valeurAttribut){
        $this->_donnees[$nomAttribut]=$valeurAttribut;
    }
    /**
     * Permet de récupérer un attribut
     * @param type $nomAttribut
     * @return type
     */
    function __get($nomAttribut){
        return $this->_donnees[$nomAttribut];
    }
    /**
     * Affiche la vue
     */
    function display(){
        include($this->_fichier);
    }
    /**
     * Permet de placer un header (haut de page) dans une vue
     * @return string
     */
    function header(){
        return '<!DOCTYPE html>
                <head>
                    <script type="text/javascript" src="./js/jquery.js"></script>

                    <link type="text/css" rel="stylesheet" href="./css/style.css" />
                </head>
                <body>';
    }
    /**
     * Permet de placer un footer (bas de page) dans une vue
     * @return string
     */
    function footer(){
        return '</body>
                </html>';
    }
    /**
     * Permet de placer le menu dans une vue
     * @return type
     */
    function menu(){
        return '<center><u><h1 class="titre">'.$this->titre.'</h1></u></center>
                <br />
                <table border="0" align="center" class="menu">
                    <tr>
                        <td align="center">menu 1</td>
                    </tr>
                    <tr>
                        <td align="center">menu 2</td>
                    </tr>
                    <tr>
                        <td align="center">menu 3</td>
                    </tr>
                    <tr>
                        <td align="center">menu 4</td>
                    </tr>
                </table>';
    }
    /**
     * Permet de créer un lien hypertext dans une vue
     * @param type $controleur
     * @param type $action
     * @param type $libelle
     * @param type $params
     * @return string
     */
    function lien($controleur,$action,$libelle,$params=array()){
        $parametres = '';
        foreach($params as $cle=>$valeur){
            $parametres.='&'.$cle.'='.$valeur.'';
        }
        $retour = '<a class="lien" href="index.php?controleur='.$controleur.'&action='.$action.$parametres.'">'.$libelle.'</a>';
        
        return $retour;
    }
}