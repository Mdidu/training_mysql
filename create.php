<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
        <div>
            <label for="available">Impraticable pour cause de :</label>
            <input type="text" name="available" value="">
        </div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
<?php
    include "connect.php";

    //Ajouter une randonnée
    if(!empty($_POST['name']) && !empty($_POST['difficulty']) && !empty($_POST['distance']) && !empty($_POST['duration']) && !empty($_POST['height_difference']) && !is_nan(floatval($_POST['distance'])) && !is_nan(floatval($_POST['duration'])) && !is_nan(floatval($_POST['height_difference']))){

        $sql = $bdd->prepare('INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES (:name, :difficulty, :distance, :duration, :height_difference)');

        $sql->bindParam(':name', $_POST['name']);
        $sql->bindParam(':difficulty', $_POST['difficulty']);
        $sql->bindParam(':distance', $_POST['distance']);
        $sql->bindParam(':duration', $_POST['duration']);
        $sql->bindParam(':height_difference', $_POST['height_difference']);

        $sql->execute();
        $sql->closeCursor();

//faire en sorte que si l'on refresh la requête ne se réexécute  pas
        $count = $sql->rowCount();
        if($count > 0){
            echo "La randonnée a été ajoutée avec succès.";
            $count = 0;
        }

    } else {
        echo "Au moins un champ n'est pas rempli !<br>";
    }

    //"Nom : ".$row['name']." difficulté : ".$row['difficulty']." distance en km : ".$row['distance']." durée : ".$row['duration']." nivelé".$row['height_difference']


