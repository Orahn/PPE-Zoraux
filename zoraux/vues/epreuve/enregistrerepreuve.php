<?php

if (isset($_SESSION['login'])) {
    echo $this->templateHaut();
    echo '<meta http-equiv="Refresh" content="0;URL=index.php?controleur=zoraux_controleurs_accueil&action=principale">';
    echo $this->templateBas();
} else {
    echo '<meta http-equiv="Refresh" content="0;URL=index.php">';
}
