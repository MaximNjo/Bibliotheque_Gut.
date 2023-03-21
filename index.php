<?php 

ob_start();
session_start();  

include "modeles/Continent.php";
include "modeles/connexionPDO.php";
include "vues/header.php";
include "vues/messageFlash.php";


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

