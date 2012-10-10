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
        /*include($this->_fichier);*/ 
    }
    /**
     * Permet de placer un header (haut de page) dans une vue
     * @return string
     */
    function header(){
        return '<!DOCTYPE html>

<!--[if IEMobile 7]><html class="no-js iem7 oldie linen"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie linen" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie linen" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9 linen" lang="en"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js linen" lang="en"><!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Zoraux</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- http://davidbcalhoun.com/2010/viewport-metatag -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- For all browsers -->
	<link rel="stylesheet" href="css/reset.css?v=1">
	<link rel="stylesheet" href="css/style.css?v=1">
	<link rel="stylesheet" href="css/colors.css?v=1">
	<link rel="stylesheet" media="print" href="css/print.css?v=1">
	<!-- For progressively larger displays -->
	<link rel="stylesheet" media="only all and (min-width: 480px)" href="css/480.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 768px)" href="css/768.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 992px)" href="css/992.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 1200px)" href="css/1200.css?v=1">
	<!-- For Retina displays -->
	<link rel="stylesheet" media="only all and (-webkit-min-device-pixel-ratio: 1.5), only screen and (-o-min-device-pixel-ratio: 3/2), only screen and (min-device-pixel-ratio: 1.5)" href="css/2x.css?v=1">

	<!-- Additional styles -->
	<link rel="stylesheet" href="css/styles/form.css?v=1">
	<link rel="stylesheet" href="css/styles/switches.css?v=1">

	<!-- Login pages styles -->
	<link rel="stylesheet" media="screen" href="css/login.css?v=1">

	<!-- JavaScript at bottom except for Modernizr -->
	<script src="js/libs/modernizr.custom.js"></script>

	<!-- For Modern Browsers -->
	<link rel="shortcut icon" href="img/favicons/favicon.png">
	<!-- For everything else -->
	<link rel="shortcut icon" href="img/favicons/favicon.ico">
	<!-- For retina screens -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/favicons/apple-touch-icon-retina.png">
	<!-- For iPad 1-->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/favicons/apple-touch-icon-ipad.png">
	<!-- For iPhone 3G, iPod Touch and Android -->
	<link rel="apple-touch-icon-precomposed" href="img/favicons/apple-touch-icon.png">

	<!-- iOS web-app metas -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!-- Startup image for web apps -->
	<link rel="apple-touch-startup-image" href="img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
	<link rel="apple-touch-startup-image" href="img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
	<link rel="apple-touch-startup-image" href="img/splash/iphone.png" media="screen and (max-device-width: 320px)">

	<!-- Microsoft clear type rendering -->
	<meta http-equiv="cleartype" content="on">

	<!-- IE9 Pinned Sites: http://msdn.microsoft.com/en-us/library/gg131029.aspx -->
	<meta name="application-name" content="Developr Admin Skin">
	<meta name="msapplication-tooltip" content="Cross-platform admin template.">
	<meta name="msapplication-starturl" content="http://www.display-inline.fr/demo/developr">
	<!-- These custom tasks are examples, you need to edit them to show actual pages -->
	<meta name="msapplication-task" content="name=Agenda;action-uri=http://www.display-inline.fr/demo/developr/agenda.html;icon-uri=http://www.display-inline.fr/demo/developr/img/favicons/favicon.ico">
	<meta name="msapplication-task" content="name=My profile;action-uri=http://www.display-inline.fr/demo/developr/profile.html;icon-uri=http://www.display-inline.fr/demo/developr/img/favicons/favicon.ico">
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
        return '<center><u><h1 class="titre">Zoraux</h1></u></center>
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
                </table>';// .$this->titre. pour afficher le titre dans la balise h1 //
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
    /**
     * Permet de placer la page d'authentification dans une vue
     * @return type
     */
    function authentification(){
        return'<div id="container">

                   <hgroup id="login-title" class="large-margin-bottom">
                       <h1 class="login-title">Zoraux</h1>
                       <h5>&copy; Lycée Notre-Dame du Roc</h5>
		   </hgroup>

                   <div id="form-wrapper">

               	       <div id="form-block" class="scratch-metal">
		           
                           <div id="form-viewport">

			       <form method="post" action="" id="form-login" class="input-wrapper blue-gradient glossy" title="">
			           <ul class="inputs black-input large">
				       <!-- The autocomplete="off" attributes is the only way to prevent webkit browsers from filling the inputs with yellow -->
				       <li><span class="icon-user mid-margin-right"></span><input type="text" name="Identifiant" id="login" value="" class="input-unstyled" placeholder="Identifiant" autocomplete="off"></li>
				       <li><span class="icon-lock mid-margin-right"></span><input type="password" name="Mot de passe" id="pass" value="" class="input-unstyled" placeholder="Mot de passe" autocomplete="off"></li>
				   </ul>

				   <p class="button-height">
				       <button type="submit" class="button glossy float-right" id="login">Se connecter</button>
				       <input type="checkbox" name="remind" id="remind" value="1" checked="checked" class="switch tiny mid-margin-right with-tooltip" title="">
				       <label for="remind">Se souvenir de moi</label>
				   </p>
			       </form>
			   </div>
		       </div>
		   </div>
	       </div>';
    }
}