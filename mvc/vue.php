<?php
class MVC_Vue{
    private $_fichier;
    private $_donnees;
    /**
     * Constructeur de la vue
     * @param string - $controleur : controleur de la vue
     * @param string - $action : action a appeler dans la vue
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
     * @param string - $nomAttribut : nom de l'element
     * @param string/int - $valeurAttribut : valeur de l'element
     */
    function __set($nomAttribut,$valeurAttribut){
        $this->_donnees[$nomAttribut]=$valeurAttribut;
    }
    /**
     * Permet de récupérer un attribut en fonction de son nom
     * @param string $nomAttribut - nom de l'attribut recherche
     * @return string/int/object
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
     * @return string : code html
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
     * @return string : code html
     */
    function footer(){
        return '</body>
                </html>';
    }
    /**
     * Permet de placer le menu dans une vue
     * @return string : code html
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
     * Permet de creer un lien hypertext dans une vue
     * @param string - $controleur : controleur souhaite dans le lien
     * @param string - $action : action voulue dans la page ciblee
     * @param string - $libelle : nom du lien
     * @param string - $params : parametre(s) a passer dans le lien necessaire dans la page ciblee pour realiser l'action voulue
     * @return string : code html
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