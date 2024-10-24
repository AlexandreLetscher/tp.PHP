<?php
require "../dao/dbConnect.php";
require "../dao/RestoTable.php";

if (isset($_POST["ajouter"])) {
    $myRestaurant = new RestoTable();
    $test = $myRestaurant->ajouterResteau($_POST["nom"], $_POST["adresse"], floatval($_POST["prix"]), $_POST["commentaire"], intval($_POST["note"]), $_POST["visite"]);
    if ($test === true) {

        echo "ligne Ajouté";
        header("Location:../index.php");
    } else {
        echo "La creation de la ligne a échoué ";
    }
}






?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>ajouter critique restaurant</title>
</head>

<body>

    <form action="ajouter.php" method="POST">
        <fieldset>
            <legend>Ajouter restaurant</legend>
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" maxlength="50">
        </div>

        <div>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" maxlength="200">
        </div>

        <div>
            <label for="prix">Prix :</label>
            <input type="number" name="prix" id="prix" min="0" max="1000" step="0.1">
        </div>

        <div>
            <label for="commentaire">Commentaire :</label>
            <textarea name="commentaire" id="commentaire" maxlength="600" rows="3"></textarea>
        </div>

        <div>
            <label for="note">Note :</label>
            <input type="number" name="note" id="note" min="0" max="10">
        </div>

        <div>
            <label for="visite">Date :</label>
            <input type="date" name="visite" id="visite">
        </div>

        <button class="btn-form" type="submit" name="ajouter">Ajouter</button>
    </fieldset>
    </form>
</body>

</html> 