<?php

if (!empty($_SERVER['HTTP_REFERER'])) {
    echo '<p><a href="' . $_SERVER['HTTP_REFERER'] . '">Retourner à la page précédente</a></p>';
}
?>