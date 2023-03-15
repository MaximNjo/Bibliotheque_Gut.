<?php
include "header.php";
include "connexionPDO.php";

$num = $_GET['num'];

$req=$monPdo->prepare("delete from nationalite  where num = :num");
$req->bindParam(':num', $num);
$nb = $req->execute();


  
    
    
if($nb == 1){

    $_SESSION['message']=['sucess'=>'La nationalité a bien été supprimé '];


} else{

    $_SESSION['message']=['danger'=>'La nationalité n"a pas été supprimé '];
    
}

header('location: listeNationalites.php');
exit();

?>

