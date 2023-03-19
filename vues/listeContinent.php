<div class="container">
  
  <h3>Liste des Continents</h3>
  
  <br>
  
  <a href="formNationalite.php?action=Ajouter" class='btn btn-sucess'> <img src="image/plus.png" width="25" > Créer un continent</a>
  

<br><br>

<div class="container">

    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <td class="col-md-2"><strong>Numéro</strong></td>
                <td class="col-md-8"><strong>Libellé</strong></td>
                <td class="col-md-2"><strong>Actions</strong></td>
            </tr>
        </thead>

    <?php


    // Afficher la requête nationalite

    foreach($lesContinents as $continent){

    echo "<tr>";
    echo "<td>" . $continent->getNum() ." </td>";
    echo "<td>" . $continent->getLibelle() ."</td>";
    echo"
    
    <td>
        <a href='formNationalite.php?action=Modifier&num=' . $continent->getNum() .''>

        <img src='image/modifier.png'>

        </a>
        
        <a href='#modalSupression' data-toggle='modal'  data-suppression='supprimerNationalite.php?num=' . $continent->getNum() .' '>
        
        <img src='image/supprimer.png'>
        
        </a>
        
        </td>
        </tr>
        
        ";

    }

    ?>

    </table>

</div>
