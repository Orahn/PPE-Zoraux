<?php
$_SESSION['id']=$this->utilisateur->id;
$_SESSION['nom']=$this->utilisateur->nom;
$_SESSION['prenom']=$this->utilisateur->prenom;
$_SESSION['rang']=$this->rang;
?>
<script type="text/javascript">
    location.replace('index.php?controleur=zoraux_controleurs_accueil&action=principale');
</script>