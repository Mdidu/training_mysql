<?php
include "connect.php";
include "check_login.php";
checking();

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $sql = $bdd->prepare("DELETE FROM hiking WHERE id = :id");

    $sql->bindParam(':id', $id);

    $sql->execute();
    $sql->closeCursor();
    header("location: read.php");
}