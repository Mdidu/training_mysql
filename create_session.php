<?php
    include "connect.php";


    function session_create(){
        global $bdd;

        if(!isset($_POST['username']) && !isset($_POST['password'])){
            // champs login ou mdp non remplis
            return;
        }
        $sql = "SELECT id, username, password FROM user";
        $res = $bdd->query($sql);

        while($row = $res->fetch()){
            //récupérer login & mdp dans la bdd pour comparer avec $_POST
            if($row['username'] == $_POST['username'] && $row['password'] == $_POST['password']){
                session_start();

                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
                break;
            }
        }
        header("location: check_login.php");
    }
    session_create();