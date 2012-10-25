<?php
if(isset($_SESSION['login'])){
    echo $_SESSION['login'];
}
?>
</script>
<body>
<div id="container">
   <hgroup id="login-title" class="large-margin-bottom">
       <h1 class="login-title"><?php echo $this->titre; ?></h1>
       <h5>&copy; Lycée Notre-Dame du Roc</h5>
   </hgroup>

   <div id="form-wrapper">

       <div id="form-block" class="scratch-metal">

           <div id="form-viewport">
               <form method="post" action="index.php?controleur=zoraux_controleurs_login&action=verification" id="form-login" class="input-wrapper blue-gradient glossy" title="Formulaire de connexion">
                    <ul class="inputs black-input large">
                            <li><span class="icon-user mid-margin-right"></span><input type="text" name="login" id="login" value="" class="input-unstyled" placeholder="Identifiant" autocomplete="off"></li>
                            <li><span class="icon-lock mid-margin-right"></span><input type="password" name="pass" id="pass" value="" class="input-unstyled" placeholder="Mot de passe" autocomplete="off"></li>
                    </ul>

                    <p class="button-height" style="height:40px">
                            <button class="button glossy float-right" id="login" style="left:-112px">Connexion</button>
                    </p>
               </form>
           </div>
       </div>
   </div>
</div>
