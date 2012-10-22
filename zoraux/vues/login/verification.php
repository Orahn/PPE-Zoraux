<?php
if($this->connexion=='ok'){
    $_SESSION['nom']=$this->utilisateur->nom;
    $_SESSION['prenom']=$this->utilisateur->prenom;
    $_SESSION['rang']=$this->rang;
    echo '<meta http-equiv="Refresh" content="0;URL=index.php?controleur=zoraux_controleurs_accueil&action=principale">';
}else{
    $_SESSION=array();
    echo '<meta http-equiv="Refresh" content="0;URL=index.php?controleur=zoraux_controleurs_login&action=auth&conn='.$this->connexion.'">';
}
?>