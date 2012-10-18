<?php
    if(isset($_SESSION['id'])){
        echo 'Bienvenue '.$_SESSION['nom'].' '.$_SESSION['prenom'].'<br />';
        if($_SESSION['rang']=='eleve'){
            echo 'Vous êtes un élève.';
        }elseif($_SESSION['rang']=='membreJury'){
            echo 'Vous êtes un professeur';
        }
    }
