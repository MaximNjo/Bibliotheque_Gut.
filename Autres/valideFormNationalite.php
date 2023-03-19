<?php
include "header.php";
include "connexionPDO.php";

$action = $_GET['action'];
$num = $_POST["num"];
$libelle = $_POST["libelle"];
$continent = $_POST["continent"];


// requête libelle
if($action == "Modifier"){

    $req=$monPdo->prepare("update nationalite set libelle = :libelle, numContinent= :continent where num = :num");
    $req->bindParam(':num', $num);
    $req->bindParam(':libelle', $libelle);
    $req->bindParam(':continent', $continent);
    

} else {

    $req=$monPdo->prepare("insert into nationalite(libelle, numContinent) values (:libelle, :continent)");
    $req->bindParam(':libelle', $libelle);
    $req->bindParam(':continent', $continent);
    
    
}

$nb = $req->execute();
$message = $action == "Modifier" ? "modifiée" : "ajoutée";

if($nb == 1){

    echo "
    
    <div class='container'>

        <div class='alert alert-sucess'>
        
            La nationalité a bien été " . $message . "

        </div>
    
    ";


} else{

    echo "
    
        <div class='alert alert-danger'>

            La nationalité n'a pas été " . $message . "
        
        </div>
    
    </div>

    ";

}

?>

<a href="listeNationalites.php" class="btn nat">Revenir à la listes</a>

<br><br>






<?php

include 'footer.php';

?>