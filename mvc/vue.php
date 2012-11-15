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
     * Permet de créer un lien hypertext dans une vue 
     * On précisera le contrôleur, l'action, le libellé affiché et les paramètres & attributs dans un tableau associatif
     * @param type $controleur
     * @param type $action
     * @param type $libelle peut être du code html
     * @param type $params tableau associatif
     * @param type $attr tableau associatif
     * @return string
     */
    function lien($controleur,$action,$libelle,$params=array(),$attr=array()){
        $parametres = '';
        $attributs = '';
        foreach($params as $cle=>$valeur){
            $parametres.='&'.$cle.'='.$valeur.'';
        }
        foreach($attr as $attribut=>$valeur){
            $attributs.=$attribut.'="'.$valeur.'" ';
        }
        $retour = '<a '.$attributs.' href="index.php?controleur='.$controleur.'&action='.$action.$parametres.'">'.$libelle.'</a>';

        return $retour;
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
                    <meta name="description" content="Application en ligne de gestion des oraux">
                    <meta name="author" content="Section SIO">

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
                    <link rel="stylesheet" href="css/styles/agenda.css?v=1">
                    <link rel="stylesheet" href="css/styles/table.css?v=1">

                    <!-- Login pages styles -->
                    <link rel="stylesheet" media="screen" href="css/login.css?v=1">
                    
                    <!-- JavaScript -->
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
                </head> ';
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
     * Footer d'importation des fichiers javascript pour un chargement plus rapide
     * @return string
     */
    function footerJS(){
        return '<script src="js/libs/jquery-1.7.2.min.js"></script>
                <script src="js/setup.js"></script>

                <!-- Template functions -->
                <script src="js/developr.input.js"></script>
                <script src="js/developr.message.js"></script>
                <script src="js/developr.notify.js"></script>
                <script src="js/developr.tooltip.js"></script>
                <script src="js/developr.navigable.js"></script>
                <script src="js/developr.calendar.js"></script>
                <script src="js/developr.agenda.js"></script>
                <script src="js/developr.table.js"></script>';
    }
    
    /**
     * Footer utilisé pour gérer les animations et vérifications du système de login
     * @return string
     */
    function footerLogin(){
        $footer = '  
                <!-- Script fourni avec le template modifié légèrement pour les besoins -->
                <script type="text/javascript">
                $(document).ready(function(){
                    var doc = $(\'html\').addClass(\'js-login\'),
                    container = $(\'#container\'),
                    formWrapper = $(\'#form-wrapper\'),
                    formBlock = $(\'#form-block\'),
                    formViewport = $(\'#form-viewport\'),
                    forms = formViewport.children(\'form\'),

                    topDoor = $(\'<div id="top-door" class="form-door"><div></div></div>\').appendTo(formViewport),
                    botDoor = $(\'<div id="bot-door" class="form-door"><div></div></div>\').appendTo(formViewport),
                    doors = topDoor.add(botDoor),

                    formSwitch = $(\'<div id="form-switch"><span class="button-group"></span></div>\').appendTo(formBlock).children(),

                    hash = (document.location.hash.length > 1) ? document.location.hash.substring(1) : false,

                    centered,

                    currentForm,

                    animInt,

                    maxHeight = false,
                    blocHeight;

                forms.each(function(i){
                            var form = $(this),
                                    height = form.outerHeight(),
                                    active = (hash === false && i === 0) || (hash === this.id),
                                    color = this.className.match(/[a-z]+-gradient/) ? \' \'+(/([a-z]+)-gradient/.exec(this.className)[1])+\'-active\' : \'\';

                            // Store size
                            form.data(\'height\', height);

                            // Min-height for mobile layout
                            if (maxHeight === false || height > maxHeight){
                                    maxHeight = height;
                            }

                            // Button in the switch
                            form.data(\'button\', $(\'<a href="#\'+this.id+\'" class="button anthracite-gradient\'+color+(active ? \' active\' : \'\')+\'">\'+this.title+\'</a>\')
                                                                    .appendTo(formSwitch)
                                                                    .data(\'form\', form));

                            // If active
                            if (active){
                                    // Store
                                    currentForm = form;

                                    // Height of viewport
                                    formViewport.height(height);
                            }else{
                                    // Hide for now
                                    form.hide();
                            }
                    });

                    // Main bloc height (without form height)
                    blocHeight = formBlock.height()-currentForm.data(\'height\');';
                    
                    /* Si conn est renvoyé, c'est que le login n'a pas été trouvé dans la BDD */
                    if(isset($_GET['conn'])){
                        $footer.= 'formWrapper.clearMessages();
                        displayError(\'Login ou mot de passe incorrect\');';
                    }

                    $footer.= '// Handle resizing (mostly for debugging)
                    function handleLoginResize(){
                            // Detect mode
                            centered = (container.css(\'position\') === \'absolute\');

                            // Set min-height for mobile layout
                            if (!centered){
                                    formWrapper.css(\'min-height\', (blocHeight+maxHeight+20)+\'px\');
                                    container.css(\'margin-top\', \'\');
                            }else{
                                    formWrapper.css(\'min-height\', \'\');
                                    if (parseInt(container.css(\'margin-top\'), 10) === 0){
                                            centerForm(currentForm, false);
                                    }
                            }
                    };

                    // Register and first call
                    $(window).bind(\'normalized-resize\', handleLoginResize);
                    handleLoginResize();

                    // Switch behavior
                    formSwitch.on(\'click\', \'a\', function(event){
                            var link = $(this),
                                    form = link.data(\'form\'),
                                    previousForm = currentForm;

                            event.preventDefault();
                            if (link.hasClass(\'active\')){
                                    return;
                            }

                            // Refresh forms sizes
                            forms.each(function(i){
                                    var form = $(this),
                                            hidden = form.is(\':hidden\'),
                                            height = form.show().outerHeight();

                                    // Store size
                                    form.data(\'height\', height);

                                    // If not active
                                    if (hidden){
                                            // Hide for now
                                            form.hide();
                                    }
                            });

                            // Clear messages
                            formWrapper.clearMessages();

                            // If an animation is already running
                            if (animInt){
                                    clearTimeout(animInt);
                            }
                            formViewport.stop(true);

                            // Update active button
                            currentForm.data(\'button\').removeClass(\'active\');
                            link.addClass(\'active\');

                            // Set as current
                            currentForm = form;

                            // if CSS transitions are available
                            if (doc.hasClass(\'csstransitions\')){
                                    // Close doors - step 1
                                    doors.removeClass(\'door-closed\').addClass(\'door-down\');
                                    animInt = setTimeout(function(){
                                            // Close doors, step 2
                                            doors.addClass(\'door-closed\');
                                            animInt = setTimeout(function(){
                                                    // Hide previous form
                                                    previousForm.hide();

                                                    // Show target form
                                                    form.show();

                                                    // Center layout
                                                    centerForm(form, true);

                                                    // Height of viewport
                                                    formViewport.animate({
                                                            height: form.data(\'height\')+\'px\'
                                                    }, function(){
                                                            // Open doors, step 1
                                                            doors.removeClass(\'door-closed\');
                                                            animInt = setTimeout(function(){
                                                                    // Open doors - step 2
                                                                    doors.removeClass(\'door-down\');
                                                            }, 300);
                                                    });
                                            }, 300);
                                    }, 300);
                            }else{
                                    // Close doors
                                    topDoor.animate({ top: \'0%\' }, 300);
                                    botDoor.animate({ top: \'50%\' }, 300, function(){
                                            // Hide previous form
                                            previousForm.hide();

                                            // Show target form
                                            form.show();

                                            // Center layout
                                            centerForm(form, true);

                                            // Height of viewport
                                            formViewport.animate({
                                                    height: form.data(\'height\')+\'px\'
                                            }, {

                                                    /* IE7 is a bit buggy, we must force redraw */
                                                    step: function(now, fx){
                                                            topDoor.hide().show();
                                                            botDoor.hide().show();
                                                            formSwitch.hide().show();
                                                    },

                                                    complete: function(){
                                                            // Open doors
                                                            topDoor.animate({ top: \'-50%\' }, 300);
                                                            botDoor.animate({ top: \'105%\' }, 300);
                                                            formSwitch.hide().show();
                                                    }
                                            });
                                    });
                            }
                    });

                    // Initial vertical adjust
                    centerForm(currentForm, false);

                    /*
                     * Center function
                     * @param jQuery form the form element whose height will be used
                     * @param boolean animate whether or not to animate the position change
                     * @param string|element|array any jQuery selector, DOM element or set of DOM elements which should be ignored
                     * @return void
                     */
                    function centerForm(form, animate, ignore){
                            // If layout is centered
                            if (centered){
                                    var siblings = formWrapper.siblings().not(\'.closing\'),
                                            finalSize = blocHeight+form.data(\'height\');

                                    // Ignored elements
                                    if (ignore){
                                            siblings = siblings.not(ignore);
                                    }

                                    // Get other elements height
                                    siblings.each(function(i){
                                            finalSize += $(this).outerHeight(true);
                                    });

                                    // Setup
                                    container[animate ? \'animate\' : \'css\']({ marginTop: -Math.round(finalSize/2)+\'px\' });
                            }
                    };

                    /**
                    * Vérification du formulaire
                    * Fonction ajoutée
                    */
                    $("#form-login").submit(function(event){
                        event.preventDefault();
                        var login = $.trim($(\'#login\').val()),
                            pass = $.trim($(\'#pass\').val());
                        if(login.length === 0){
                            formWrapper.clearMessages();
                            displayError(\'Veuillez renseigner votre identifiant\');
                        }else if(pass.length === 0){
                            formWrapper.clearMessages();
                            displayError(\'Veuillez renseigner votre mot de passe\')
                        }else{
                            formWrapper.clearMessages();
                            displayLoading(\'Vérification des informations...\');
                            var controleur = \'zoraux_controleurs_login\',
                                action = \'verification\';
                            setTimeout(function(){
                                location.replace(\'index.php?controleur=\'+controleur+\'&action=\'+action+\'&login=\'+login+\'&pass=\'+pass);
                            },1000);            
                        }
                    });

                    /**
                     * Function to display error messages
                     * @param string message the error to display
                     */
                    function displayError(message){
                            // Show message
                            var message = formWrapper.message(message, {
                                    append: false,
                                    arrow: \'bottom\',
                                    classes: [\'red-gradient\'],
                                    animate: false
                            });

                            // Vertical centering (where we need the message height)
                            centerForm(currentForm, true, \'fast\');

                            // Watch for closing and show with effect
                            message.bind(\'endfade\', function(event){
                                    // This will be called once the message has faded away and is removed
                                    centerForm(currentForm, true, message.get(0));

                            }).hide().slideDown(\'fast\');
                    };

                    /**
                     * Function to display loading messages
                     * @param string message the message to display
                     */
                    function displayLoading(message){
                            // Show message
                            var message = formWrapper.message(\'<strong>\'+message+\'</strong>\', {
                                    append: false,
                                    arrow: \'bottom\',
                                    classes: [\'blue-gradient\', \'align-center\'],
                                    stripes: true,
                                    darkStripes: false,
                                    closable: false,
                                    animate: false
                            });

                            // Vertical centering (where we need the message height)
                            centerForm(currentForm, true, \'fast\');

                            // Watch for closing and show with effect
                            message.bind(\'endfade\', function(event){
                                    // This will be called once the message has faded away and is removed
                                    centerForm(currentForm, true, message.get(0));

                            }).hide().slideDown(\'fast\');
                    };
                });
                </script>';
    return $footer;
    }
    
    /**
     * Partie haute du template developr
     * @return type
     */
    function templateHaut(){
        $date = new MVC_Date(date('Y-m-d'));
        return '<body class="clearfix with-menu with-shortcuts reversed">

	<!-- Informe les utilisateurs d\'IE6 qu\'ils peuvent installer chrome -->
	<!--[if lt IE 7]><p class="message red-gradient simpler">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

	<!-- Barre de titre -->
	<header role="banner" id="title-bar">
		<h2>Zoraux</h2>
	</header>

	<!-- Bouton pour ouvrir / fermer le menu principal -->
	'.$this->lien('','','<span>Menu</span>',array(),array('id'=>'open-menu')).'

	<!-- Contenu principal -->
	<section role="main" id="main">

		<!-- Visible seulement pour les navigateurs sans JavaScript -->
		<noscript class="message black-gradient simpler">Your browser does not support JavaScript! Some features won\'t work as expected...</noscript>

		<!-- Titre de la page (vue) -->
		<hgroup id="main-title" class="thin">
			<h1 class="silver">'.$this->titre.'</h1>
			<h2 class="silver">'.$date->getFr().'</h2>
		</hgroup>

		<div class="with-padding">';
    }
    
    /**
     * Partie basse et menus du template developr
     * @return string
     */
    function templateBas(){
        $menu = '</div>

	</section>

	<!-- Menu principal -->
	<section id="menu" role="complementary">

		<div id="menu-content">

			<header>
				'.$this->rang.'
			</header>

			<div id="profile">
				<img src="img/user.png" width="64" height="64" alt="User name" class="user-icon">
				Bienvenue
				<span class="name">'.$this->utilisateur->prenom.' <b>'.$this->utilisateur->nom.'</b>'.'</span>
			</div>

			<ul id="access" class="children-tooltip">
				<li>
                                    '.$this->lien('zoraux_controleurs_accueil','monCompte','<span class="icon-user"></span>',array(),array('title'=>'Mon compte')).'
				</li>
                                <li>
                                    '.$this->lien('','','<span class="icon-printer"></span>',array(),array('title'=>'Imprimer la page')).'
				</li>
                                <li>
                                    '.$this->lien('zoraux_controleurs_login','deconnexion','<span class="icon-lock"></span>',array(),array('title'=>'Déconnexion')).'
				</li>
			</ul>';
        /* Si l'utilisateur est un élève, on affiche le menu des élèves */
        if($this->rang=='eleve'){
            $menu.= '<section class="navigable">
                    <ul class="big-menu">
                    <li class="with-right-arrow">
                    <span>Mes épreuves</span>
                    <ul class="big-menu">
                        <li>
                            '.$this->lien('zoraux_controleurs_epreuve','listeEpreuvesClasse','<span class="list-count">'.count($this->epreuves).'</span>Voir les épreuves',array(),array('title'=>'Voir les épreuves')).'
                        </li>
                        <li>
                            '.$this->lien('zoraux_controleurs_accueil','calendrier','Calendrier de mes passages',array(),array('title'=>'Calendrier')).'
                        </li>
                    </ul>
                </li>
            </ul
            </section>';
        }
        /* Si l'utilisateur est un professeur (membreJury) on affiche un menu différent) */
        if($this->rang=='professeur' || $this->rang=='administrateur'){
            $menu.= '<section class="navigable">
            <ul class="big-menu">
                <li class="with-right-arrow">
                    <span>Gestion des épreuves</span>
                    <ul class="big-menu">
                        <li>
                            <a href="?controleur=zoraux_controleurs_epreuve&action=listeEpreuves" title="Liste">Liste des épreuves par classe</a>
                        </li>
                        <li>
                            '.$this->lien('zoraux_controleurs_epreuve','formEpreuve','Enregistrer une épreuve',array(),array('title'=>'Enregistrer')).'
                        </li>
                        <li>
                            '.$this->lien('Zoraux_Controleurs_MembreJuryEpreuve','formMembreJuryEpreuve','Affecter des membres du jury à une épreuve',array(),array('title'=>'Affecter des membres du jury')).'
                        </li>
                        <li>
                            '.$this->lien('Zoraux_Controleurs_SalleEpreuve','formSalleEpreuve','Affecter des salles à une épreuve',array(),array('title'=>'Affecter des salles')).'
                        </li>
                        <li>
                            '.$this->lien('zoraux_controleurs_accueil','calendrier','Calendrier de mes passages',array(),array('title'=>'Calendrier')).'
                        </li>
                        <li>
                            <a href="#" title="Liste">Liste des jury</a>
                        </li>
                    </ul>
                </li>
            </ul
            </section>';
        }
        $menu.= '</div>
                </section>';
        return $menu;
    }
}