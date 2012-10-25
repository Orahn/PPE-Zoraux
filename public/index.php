<?php
session_start();
    error_reporting(E_ALL);
    ini_set('display_errors','1');
    include('./params/params_chemins.php');
    include('./params/params_bdd.php');
    include(Params_Chemins::MVC.'index.php');
