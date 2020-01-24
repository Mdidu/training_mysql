<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <table>
      <!-- Afficher la liste des randonnées -->
        <?php
            include "connect.php";

            //afficher la liste des randonnées !
            $sql = "SELECT * FROM hiking";
            $res = $bdd->query($sql);

            while($row = $res->fetch()){
                $id = $row['id'];
                $name = $row['name'];
                $difficulty = $row['difficulty'];
                $distance = $row['distance'];
                $duration = $row['duration'];
                $height_diff = $row['height_difference'];
                $available = $row['available'];

                echo <<<TABLE
                <tr>
                    <td>Nom : <a href="update.php?id=$id">$name</a></td>
                    <td>Difficulté : $difficulty </td>
                    <td>Distance : $distance </td>
                    <td>Durée : $duration </td>
                    <td>Nivelé : $height_diff </td>
                    <td>Impaticable pour cause de : $available </td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="$id">
                            <input type="submit" value="Supprimer cette ligne">
                        </form>
                    </td>
                </tr>
TABLE;
            }
            ?>
    </table>
  </body>
</html>
