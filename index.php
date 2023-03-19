<?php session_start();  

include "vues/header.php";
include "modeles/Continent.php";
include "modeles/connexionPDO.php";


?>

<?php $uc = empty($_GET['uc']) ? "accueil" : $_GET["uc"]; 

switch($uc){

    case 'accueil' :
        include('vues/Accueil.php');
    break;
    case 'continents' :
        include('controllers/continentController.php');
    break;

}

?>

<?php 

echo "<br><br>";
include "vues/footer.php";


?>

