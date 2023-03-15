<?php


include "header.php";
@$action = $_GET['action'];
include "connexionPDO.php "; 



if($action == "Modifier"){

    
    $num = $_GET['num'];
    $req=$monPdo->prepare("select * from nationalite where num= :num");
    $req->setFetchMode(PDO::FETCH_OBJ);
    $req->bindParam(':num', $num);
    $req->execute();
    $lesNationalites=$req->fetch();

}


// liste des continents

    $reqContinent=$monPdo->prepare("select * from continent");
    $reqContinent->setFetchMode(PDO::FETCH_OBJ);
    $reqContinent->execute();
    $lesContinents=$reqContinent->fetchAll();

?>

<div class="titreH2">

    <h2> <?php echo $action ?> une nationalité </h2>
    
</div>

<br>


<div class="formulaire">

    <form action="valideFormNationalite.php?action=<?php echo $action; ?>" method="post" >
    
    <div class="form-group">
        
        <label for="libelle">Libellé</label>
        <input type="text" class="form-control" id="libelle" placeholder="Saisir le libellé" name="libelle"  value= "<?php if($action == "Modifier") { echo $lesNationalites->libelle; } ?>">
        
    </div>

    <!-- CONTINENT -->

    <div class="form-group">
        
        <label for="continent">Continent</label>
        <select name="continent" class="form-control">
        <?php        
        
        foreach($lesContinents as $continent){
            
            $selection = $continent->num == $lesNationalites->numContinent ? 'selected' : '';
            echo " 
            <option value='$continent->num' $selection> $continent->libelle</option>
            
            ";
            
        }
        ?>

        </select>
    </div>

    <input type="hidden" id="num" name="num" value=" <?php if($action == "Modifier") { echo $lesNationalites->num; } ?>" >
    <div class="row">
        
        <div class="col"> 
            <a href="listeNationalites.php" class="btn nat">Revenir à la listes</a>
        &nbsp;&nbsp;&nbsp;
            <button type="submit"> <?php echo $action; ?>  </button>
        </div>
        
    </div>
    
    
</form>

</div>

<br>

<?php

    include "footer.php";


?>