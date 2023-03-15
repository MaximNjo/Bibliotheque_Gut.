<?php session_start(); ?>
    
<?php include "vues/header.php";  ?>

<?php $uc = empty($_GET['uc']) ? "accueil" : $_GET["uc"]; 

switch($uc){

    case 'accueil' :
        include('vues/Accueil.php');
        break;
    case 'continents' :
        break;

}

?>

<?php include "vues/footer.php";  ?>

