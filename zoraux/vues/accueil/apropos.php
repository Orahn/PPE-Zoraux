<?php

$aPropos = 'Bienvenue sur l\'application "Zoraux", cette application permet la gestion des épreuves CCF et oraux des Lycées professionnels et hôteliers.<br />
            Elle est actuellement développée par la section SLAM du BTS SIO 2ème année.';
if (isset($_SESSION['login']) AND $_SESSION['rang']=='administrateur') {
    echo $this->templateHaut();
    echo '<textarea class="input full-width autoexpanding">'.$aPropos.'</textarea>';
    echo $this->templateBas();
} else {
    echo '<meta http-equiv="Refresh" content="0;URL=index.php">';
}