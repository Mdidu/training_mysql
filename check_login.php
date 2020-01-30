<?php
//Check if credentials are valid
session_start();
include "connect.php";

function checking(){
    if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
        echo "variable non déclaré";
    }
}