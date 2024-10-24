<?php

$message = "";
require "./dao/dbConnect.php";
require "./dao/RestoTable.php";
//  require "./views/modifier.php";


$myRestoTable = new Restotable();
if (isset($_GET["idsuppr"]) && !empty($_GET["idsuppr"])) {

    $nbligne = $myRestoTable->deleteRestau(intval($_GET["idsuppr"]));
    if ($nbligne === 1) {
        header("Location:./index.php");
    } else {
        $message = "Supression échoué";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion liste restaurants</title>
    <link rel="stylesheet" href="./CSS/style.css">
</head>

<body>
    <?php



    //var_dump($myRestoTable->afficherRestaurants());

    //var_dump($myRestoTable->rechercherResto("Jean ives Scilinger"));

    ?>
    <h1>Liste restaurants </h1>

    <button class="btn" id="ajouter"><a href="./views/ajouter.php"> Ajouter un Restaurant </a></button>
    <?php
    echo $message;
    ?>
    <table>

        <thead>

            <tr>
                <th>Suppression</th>
                <th>Modification</th>
                <th>id</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Prix</th>
                <th>Commentaire</th>
                <th>Note</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tabData = $myRestoTable->afficherRestaurants();

            for ($i = 0; $i < count($tabData); $i++) {
                echo '<tr><th><form action="index.php" method="GET"> 
                <input name="idsuppr" type="hidden" value="' . $tabData[$i]["id"] . '"><button class="btn1"
                
                type="submit" name="supprimer">Supprimer</button">   
                </form></th><th><a class="btn1" href="./views/modifier.php?id=' . $tabData[$i]["id"] . '">Modifier</a></th>';
                foreach ($tabData[$i] as $key => $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }


            ?>
        </tbody>

    </table>

</body>

</html>