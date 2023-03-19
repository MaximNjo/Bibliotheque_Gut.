<?php 

include "header.php "; 
include "connexionPDO.php "; 
// $action = $_GET['action'];


// Création requete nationalite
$libelle = "";
$continentSel = "tous";

$texteReq = "select n.num, n.libelle as 'libNation', c.libelle as 'libContinent' from nationalite n, continent c where n.numContinent=c.num";

if(!empty($_GET)){

  $libelle = $_GET['libelle'];
  $continentSel = $_GET['continent'];

  if($libelle != ""){ $texteReq.= " and n.libelle like '%" . $_GET['libelle']."%'";}
  if($continentSel != "tous"){ $texteReq.= " and c.num =" .$continentSel;}

}

$texteReq.= " order by n.libelle";

$req=$monPdo->prepare($texteReq);
$req->setFetchMode(PDO::FETCH_OBJ);
$req->execute();
$lesNationalites=$req->fetchAll();

// Liste des continents

$reqContinent=$monPdo->prepare("select * from continent");
$reqContinent->setFetchMode(PDO::FETCH_OBJ);
$reqContinent->execute();
$lesContinents=$reqContinent->fetchAll();

if(!empty($_SESSION['message'])){

  $mesMessages=$_SESSION['message'];
  foreach($mesMessages as $key=>$message){

    echo '
      <div class="alert alert-' .$key. ' alert-dismissible fade show" role="alert">

        ' .$message . '

         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>

    </div>';
  }
  $_SESSION['message']=[];
}

?>



<!-- Titre + bouton "ajouter nationalité"  -->

<div class="container">
  
  <h3>Liste des Nationalités</h3>
  
  <br>
  
  <a href="formNationalite.php?action=Ajouter" class='btn btn-sucess'> <img src="image/plus.png" width="25" > Créer une nationalité</a>
  

  <br><br>

  <!-- DEL -->


  <form action="" method="get" class="border border-primary rounded p-3">

  <div class="row">

    <!-- FORM -->
      <div class="col">

        <input type="text" class="form-control" id="libelle" placeholder="Saisir le libellé" name="libelle"  value= "<?php $libelle; ?>">
         
      </div>
    <!-- Listes déroulantes -->
      <div class="col">
      <select name="continent" class="form-control">
            <?php      
            
            echo " 
                <option value='tous'> Tous les continents</option>
                
                ";
            
            foreach($lesContinents as $continent){
                
                $selection = $continent->num == $continentSel ? 'selected' : '';
                echo " 
                <option value='$continent->num' $selection> $continent->libelle</option>
                
                ";
                
            }
            ?>

            </select>
      </div>
      <!-- BUTTON -->
      <div class="col">
            
        <button type="submit" class="btn btn-success btn-block">Rechercher</button>

      </div>

  </div>

  </form>

</div>

<br><br>

<!-- Tableaux -->
<div class="container">

<table class="table table-hover table-dark">
    <thead>
      <tr>
        <td class="col-md-2"><strong>Numéro</strong></td>
        <td class="col-md-4"><strong>Libellé</strong></td>
        <td class="col-md-3"><strong>Continent</strong></td>
        <td class="col-md-2"><strong>Actions</strong></td>
      </tr>
    </thead>


<?php


// Afficher la requête nationalite

foreach($lesNationalites as $nationalite)

  {

  echo "<tr>";
  echo "<td>$nationalite->num</td>";
  echo "<td>$nationalite->libNation</td>";
  echo "<td>$nationalite->libContinent</td>";
  echo"
 
  <td>
    <a href='formNationalite.php?action=Modifier&num=$nationalite->num'>

      <img src='image/modifier.png'>

    </a>
    
    <a href='#modalSupression' data-toggle='modal'  data-suppression='supprimerNationalite.php?num=$nationalite->num'>
      
      <img src='image/supprimer.png'>
    
    </a>
    
    </td>
    </tr>
    
    ";

  }

  ?>

  </table>

</div>



<br>
<!-- Boîtes de dialogue -->
<div class="dialecte">

  
  <div id="modalSupression" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ATTENTION</h5>
        </div>
        <div class="modal-body">
          <p>Voulez vous supprimer cette nationalité !</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne pas supprimer</button>
          <a href="" type="button" id="btnSuppr" class="btn btn-danger" >Supprimer</a>
        </div>
      </div>
    </div>
  </div>

  
</div>

<?php 
  include "footer.php"; 

?>
