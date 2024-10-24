<?php
require "../dao/dbConnect.php";
require "../dao/RestoTable.php";




$myRestoTable = new Restotable();
$mytable = [];
if (!empty($_GET['id'])) {
    $mytable =  $myRestoTable->searchOne(intval($_GET['id']));

    //  var_export($mytable);
}
if (isset($_POST["valider"])) {



    $nbligne = $myRestoTable->upDateRow($_POST["nom"], $_POST["adresse"], floatval($_POST["prix"]), $_POST["commentaire"], floatval($_POST["note"]), $_POST["madate"], $_GET["id"]);
    if ($nbligne === 1) {
        header('Location:../index.php');
        exit;
    } else {
        echo "la mise a jour a echoué";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Document</title>
</head>

<body>


<fieldset>
    <legend>Modifier restaurant</legend>
    <form action="<?= $_SERVER["PHP_SELF"] . "?id=" . $_GET['id'] ?>" method="POST">
        <a href="/index.php"> retour page d'accueil</a>
        
        <div>
            <label>Nom :</label>
            <input class="inp" type="text" name="nom" value="<?= $mytable[0]['Nom'] ?>">
        </div>

        <div>
            <label>Adresse :</label>
            <input class="inp" type="text" name="adresse" value="<?= $mytable[0]['adresse'] ?>">
        </div>

        <div>
            <label>Prix :</label>

            <input type="number" min="0" max="1000" name="prix" step="0.1" value="<?= $mytable[0]['prix'] ?>">
        </div>

        <label>Commentaire :</label>
        <input class="inp" type="text" name="commentaire" value="<?= $mytable[0]['commentaire'] ?>">
        </div>

        <div>
            <label>Note :</label>
            <input type="number" name="note" min="0" max="10" value="<?= $mytable[0]['note'] ?>">
        </div>

        <div>
            <label>Date :</label>
            <input type="date" name="madate" value="<?= $mytable[0]['visite'] ?>">
        </div>
        <button class="btn-form" type="submit" name="valider">Modifier</button>

</fieldset>
    </form>
</body>

</html>