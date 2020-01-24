<?php
    include "connect.php";

    if(!isset($_GET['id'])):
        echo "Inexistant";
    else:
        $id = $_GET['id'];


        $sql = "SELECT * FROM hiking WHERE id = ".$id;

        $res = $bdd->query($sql);

        while ($row = $res->fetch()):

           $name = $row['name'];
           $difficulty = $row['difficulty'];
           $distance = $row['distance'];
           $duration = $row['duration'];
           $height_difference = $row['height_difference'];
           $available = $row['available'];

        endwhile;
    endif;
    $tab = ["très facile", "facile", "moyen", "difficile", "très difficile"];
?>
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
			<input type="text" name="name" value="<?= $name;?>">

        </div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">

				<option value="très facile">Très facile</option>
				<option value="facile" <?php if($tab[1] == $difficulty): echo 'selected="selected"'; endif;?>>Facile</option>
				<option value="moyen"<?php if($tab[2] == $difficulty): echo 'selected="selected"';endif;?>>Moyen</option>
				<option value="difficile"<?php if($tab[3] == $difficulty): echo 'selected="selected"';endif;?>>Difficile</option>
				<option value="très difficile" <?php if($tab[4] == $difficulty): echo 'selected="selected"';endif;?>>Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?= $distance;?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?= $duration;?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?= $height_difference;?>">
		</div>
        <div>
            <label for="available">Impraticable pour cause de </label>
            <input type="text" name="available" value="<?= $available;?>">
        </div>
        <input type="hidden" name="id" value="<?= $id;?>">
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
<?php
    // en cours à terminer !! elle marche pas la requête

    if(!empty($_POST['name']) && !empty($_POST['difficulty']) && !empty($_POST['distance']) && !empty($_POST['duration']) && !empty($_POST['height_difference'])){
        $idPost = $_POST['id'];
        $sql = $bdd->prepare("UPDATE `hiking` SET `name` = :name, `difficulty` = :difficulty, `distance` = :distance, `duration` = :duration, `height_difference` = :height_difference, `available` =  :available WHERE id = ".$idPost);

        $sql->bindParam(':name', $_POST['name']);
        $sql->bindParam(':difficulty', $_POST['difficulty']);
        $sql->bindParam(':distance', $_POST['distance']);
        $sql->bindParam(':duration', $_POST['duration']);
        $sql->bindParam(':height_difference', $_POST['height_difference']);
        $sql->bindParam(':available', $_POST['available']);

        $sql->execute();
        $sql->closeCursor();

//faire en sorte que si l'on refresh la requête ne se réexécute  pas
        $count = $sql->rowCount();
        if($count > 0){
            echo "La randonnée a été modifié avec succès.";
            $count = 0;
        }

    } else {
        echo "Au moins un champ n'est pas rempli !<br>";
    }

