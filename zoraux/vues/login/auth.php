<?php
if(isset($_SESSION['login'])){
    echo $_SESSION['login'];
}
?>
<script type="text/javascript">
$(document).ready(function(){
    var doc = $('html').addClass('js-login'),
    container = $('#container'),
    formWrapper = $('#form-wrapper'),
    formBlock = $('#form-block'),
    formViewport = $('#form-viewport'),
    forms = formViewport.children('form'),

    topDoor = $('<div id="top-door" class="form-door"><div></div></div>').appendTo(formViewport),
    botDoor = $('<div id="bot-door" class="form-door"><div></div></div>').appendTo(formViewport),
    doors = topDoor.add(botDoor),

    formSwitch = $('<div id="form-switch"><span class="button-group"></span></div>').appendTo(formBlock).children(),

    hash = (document.location.hash.length > 1) ? document.location.hash.substring(1) : false,

    centered,

    currentForm,

    animInt,

    maxHeight = false,
    blocHeight;
    
    $('#form-login').submit(function(event){
        // Values
        var login = $.trim($('#login').val()),
                pass = $.trim($('#pass').val());

        // Check inputs
        if (login.length === 0){
                // Display message
                displayError('Veuillez entrer votre identifiant');
                return false;
        }else if (pass.length === 0){
                // Remove empty login message if displayed
                formWrapper.clearMessages('Veuillez entrer votre identifiant');

                // Display message
                displayError('Veuillez entrer votre mot de passe');
                return false;
        }else{
                // Remove previous messages
                formWrapper.clearMessages();

                // Show progress
                displayLoading('Recherche des informations...');

                // Stop normal behavior
                event.preventDefault();

                 $.ajax({
                                url:'????????????????????????',
                 		data: {
                 			login:	login,
                 			pass:	pass
                 		},
                 		success: function(data){
                                        
                 			if (data=="success"){
                 				document.location.href = 'index.php?controleur=zoraux_controleurs_accueil&action=principale';
                 			}else{
                 				formWrapper.clearMessages();
                 				displayError('Utilisateur ou mot de passe invalide, veuillez réessayer');
                 			}
                 		},
                 		error: function(){
                 			formWrapper.clearMessages();
                 			displayError('Erreur de connexion avec le serveur');
                 		}
                 });
                 

                // Simulate server-side check
                setTimeout(function() {
                        document.location.href = './'
                }, 2000);
        }
});

/*
 * Password recovery
 */
$('#form-password').submit(function(event){
        // Values
        var mail = $.trim($('#mail').val());

        // Check inputs
        if (mail.length === 0){
                // Display message
                displayError('Veuillez entrer votre email');
        }else if (!/^[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(mail)){
                // Remove empty email message if displayed
                formWrapper.clearMessages('Veuillez entrer votre email');

                // Display message
                displayError('Email invalide');
                return false;
        }else{
                // Remove previous messages
                formWrapper.clearMessages();

                // Show progress
                displayLoading('Recherche des informations...');

                // Stop normal behavior
                event.preventDefault();

                /*
                 * This is where you may do your AJAX call
                 */

                // Simulate server-side check
                setTimeout(function() {
                        document.location.href = './'
                }, 2000);
        }
});

/*
 * Register
 */
$('#form-register').submit(function(event){
        // Values
        var name = $.trim($('#name-register').val()),
                mail = $.trim($('#mail-register').val()),
                login = $.trim($('#login-register').val()),
                pass = $.trim($('#pass-register').val()),
                secondname = $.trim($('#secondname-register').val());

        // Remove previous messages
        formWrapper.clearMessages();

        // Check inputs
        if (name.length === 0){
                // Display message
                displayError('Veuillez entrer votre nom');
                return false;
        }else if (secondname.length === 0){
                displayError('Veuillez entrer votre prénom');
                return false;
        }else if (mail.length === 0){
                // Display message
                displayError('Veuillez entrer votre email');
                return false;
        }else if (!/^[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(mail)){
                // Display message
                displayError('Email invalide');
                return false;
        }else if (login.length === 0){
                // Display message
                displayError('Veuillez entrer votre identifiant');
                return false;
        }else if (pass.length === 0){
                // Display message
                displayError('Veuillez entrer votre mot de passe');
                return false;
        }else{
                // Show progress
                displayLoading('Inscription...');

                // Stop normal behavior
                event.preventDefault();

                /*
                 * This is where you may do your AJAX call
                 */

                // Simulate server-side check
                setTimeout(function() {
                        document.location.href = './'
                }, 2000);
        }
});

forms.each(function(i){
            var form = $(this),
                    height = form.outerHeight(),
                    active = (hash === false && i === 0) || (hash === this.id),
                    color = this.className.match(/[a-z]+-gradient/) ? ' '+(/([a-z]+)-gradient/.exec(this.className)[1])+'-active' : '';

            // Store size
            form.data('height', height);

            // Min-height for mobile layout
            if (maxHeight === false || height > maxHeight){
                    maxHeight = height;
            }

            // Button in the switch
            form.data('button', $('<a href="#'+this.id+'" class="button anthracite-gradient'+color+(active ? ' active' : '')+'">'+this.title+'</a>')
                                                    .appendTo(formSwitch)
                                                    .data('form', form));

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
    blocHeight = formBlock.height()-currentForm.data('height');

    // Handle resizing (mostly for debugging)
    function handleLoginResize(){
            // Detect mode
            centered = (container.css('position') === 'absolute');

            // Set min-height for mobile layout
            if (!centered){
                    formWrapper.css('min-height', (blocHeight+maxHeight+20)+'px');
                    container.css('margin-top', '');
            }else{
                    formWrapper.css('min-height', '');
                    if (parseInt(container.css('margin-top'), 10) === 0){
                            centerForm(currentForm, false);
                    }
            }
    };

    // Register and first call
    $(window).bind('normalized-resize', handleLoginResize);
    handleLoginResize();

    // Switch behavior
    formSwitch.on('click', 'a', function(event){
            var link = $(this),
                    form = link.data('form'),
                    previousForm = currentForm;

            event.preventDefault();
            if (link.hasClass('active')){
                    return;
            }

            // Refresh forms sizes
            forms.each(function(i){
                    var form = $(this),
                            hidden = form.is(':hidden'),
                            height = form.show().outerHeight();

                    // Store size
                    form.data('height', height);

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
            currentForm.data('button').removeClass('active');
            link.addClass('active');

            // Set as current
            currentForm = form;

            // if CSS transitions are available
            if (doc.hasClass('csstransitions')){
                    // Close doors - step 1
                    doors.removeClass('door-closed').addClass('door-down');
                    animInt = setTimeout(function(){
                            // Close doors, step 2
                            doors.addClass('door-closed');
                            animInt = setTimeout(function(){
                                    // Hide previous form
                                    previousForm.hide();

                                    // Show target form
                                    form.show();

                                    // Center layout
                                    centerForm(form, true);

                                    // Height of viewport
                                    formViewport.animate({
                                            height: form.data('height')+'px'
                                    }, function(){
                                            // Open doors, step 1
                                            doors.removeClass('door-closed');
                                            animInt = setTimeout(function(){
                                                    // Open doors - step 2
                                                    doors.removeClass('door-down');
                                            }, 300);
                                    });
                            }, 300);
                    }, 300);
            }else{
                    // Close doors
                    topDoor.animate({ top: '0%' }, 300);
                    botDoor.animate({ top: '50%' }, 300, function(){
                            // Hide previous form
                            previousForm.hide();

                            // Show target form
                            form.show();

                            // Center layout
                            centerForm(form, true);

                            // Height of viewport
                            formViewport.animate({
                                    height: form.data('height')+'px'
                            }, {

                                    /* IE7 is a bit buggy, we must force redraw */
                                    step: function(now, fx){
                                            topDoor.hide().show();
                                            botDoor.hide().show();
                                            formSwitch.hide().show();
                                    },

                                    complete: function(){
                                            // Open doors
                                            topDoor.animate({ top: '-50%' }, 300);
                                            botDoor.animate({ top: '105%' }, 300);
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
                    var siblings = formWrapper.siblings().not('.closing'),
                            finalSize = blocHeight+form.data('height');

                    // Ignored elements
                    if (ignore){
                            siblings = siblings.not(ignore);
                    }

                    // Get other elements height
                    siblings.each(function(i){
                            finalSize += $(this).outerHeight(true);
                    });

                    // Setup
                    container[animate ? 'animate' : 'css']({ marginTop: -Math.round(finalSize/2)+'px' });
            }
    };

    /**
     * Function to display error messages
     * @param string message the error to display
     */
    function displayError(message){
            // Show message
            var message = formWrapper.message(message, {
                    append: false,
                    arrow: 'bottom',
                    classes: ['red-gradient'],
                    animate: false					// We'll do animation later, we need to know the message height first
            });

            // Vertical centering (where we need the message height)
            centerForm(currentForm, true, 'fast');

            // Watch for closing and show with effect
            message.bind('endfade', function(event){
                    // This will be called once the message has faded away and is removed
                    centerForm(currentForm, true, message.get(0));

            }).hide().slideDown('fast');
    };

    /**
     * Function to display loading messages
     * @param string message the message to display
     */
    function displayLoading(message){
            // Show message
            var message = formWrapper.message('<strong>'+message+'</strong>', {
                    append: false,
                    arrow: 'bottom',
                    classes: ['blue-gradient', 'align-center'],
                    stripes: true,
                    darkStripes: false,
                    closable: false,
                    animate: false					// We'll do animation later, we need to know the message height first
            });

            // Vertical centering (where we need the message height)
            centerForm(currentForm, true, 'fast');

            // Watch for closing and show with effect
            message.bind('endfade', function(event){
                    // This will be called once the message has faded away and is removed
                    centerForm(currentForm, true, message.get(0));

            }).hide().slideDown('fast');
    };
});

</script>

<div id="container">
   <hgroup id="login-title" class="large-margin-bottom">
       <h1 class="login-title"><?php echo $this->titre; ?></h1>
       <h5>&copy; Lycée Notre-Dame du Roc</h5>
   </hgroup>

   <div id="form-wrapper">

       <div id="form-block" class="scratch-metal">

           <div id="form-viewport">

               <form method="post" action="" id="form-login" class="input-wrapper blue-gradient glossy" title="Connexion">
                    <ul class="inputs black-input large">
                            <!-- The autocomplete="off" attributes is the only way to prevent webkit browsers from filling the inputs with yellow -->
                            <li><span class="icon-user mid-margin-right"></span><input type="text" name="login" id="login" value="" class="input-unstyled" placeholder="Identifiant" autocomplete="off"></li>
                            <li><span class="icon-lock mid-margin-right"></span><input type="password" name="pass" id="pass" value="" class="input-unstyled" placeholder="Mot de passe" autocomplete="off"></li>
                    </ul>

                    <p class="button-height">
                            <button type="submit" class="button glossy float-right" id="login">Connexion</button>
                            <input type="checkbox" name="remind" id="remind" value="1" checked="checked" class="switch tiny mid-margin-right with-tooltip" title="Active la connexion automatique">
                            <label for="remind">Se souvenir de moi</label>
                    </p>
               </form>
               <form method="post" action="" id="form-password" class="input-wrapper orange-gradient glossy" title="Mot de passe oublié?">

                    <p class="message">
                            Si vous ne vous souvenez pas de votre mot de passe, renseignez votre adresse mail et un nouveau vous sera envoyé :
                            <span class="block-arrow"><span></span></span>
                    </p>

                    <ul class="inputs black-input large">
                            <li><span class="icon-mail mid-margin-right"></span><input type="email" name="mail" id="mail" value="" class="input-unstyled" placeholder="Votre email" autocomplete="off"></li>
                    </ul>

                    <button type="submit" class="button glossy full-width" id="send-password">Envoyer</button>

               </form>
               <form method="post" action="" id="form-register" class="input-wrapper green-gradient glossy" title="Inscription">

                    <p class="message">
                            Un compte a normalement déjà été créé pour vous, renseignez-vous avant de créer un nouveau compte sur Zoraux. Si toutefois vous décidiez de créer un compte, sachez qu'il sera inactif jusqu'à ce qu'un professeur le valide.
                            <span class="block-arrow"><span></span></span>
                    </p>

                    <ul class="inputs black-input large">
                            <li><span class="icon-card mid-margin-right"></span><input type="text" name="name" id="name-register" value="" class="input-unstyled" placeholder="Votre nom" autocomplete="off"></li>
                            <li><span class="icon-card mid-margin-right"></span><input type="text" name="secondname" id="secondname-register" value="" class="input-unstyled" placeholder="Votre prénom" autocomplete="off"></li>
                            <li><span class="icon-mail mid-margin-right"></span><input type="email" name="mail" id="mail-register" value="" class="input-unstyled" placeholder="Votre email" autocomplete="off"></li>
                    </ul>
                    <ul class="inputs black-input large">
                            <li><span class="icon-user mid-margin-right"></span><input type="text" name="login" id="login-register" value="" class="input-unstyled" placeholder="Identifiant" autocomplete="off"></li>
                            <li><span class="icon-lock mid-margin-right"></span><input type="password" name="pass" id="pass-register" value="" class="input-unstyled" placeholder="Mot de passe" autocomplete="off"></li>
                    </ul>

                    <button type="submit" class="button glossy full-width" id="send-register">Inscription</button>

               </form>
           </div>
       </div>
   </div>
</div>
