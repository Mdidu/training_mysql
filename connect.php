<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "reunion_island";

    try
    {
        $bdd = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password);
    }
    catch (Exception $e)
    {
        die('Erreur : '. $e->getMessage());
    }