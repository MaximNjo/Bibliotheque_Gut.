<div class="container">

    <h2>Listes des Nationalités</h2>

    <form action="index.php?uc=nationalites&action=list" method="post">

        <!-- Listes déroulantes -->
        <div class="col">
            <select name="continent" class="form-control">
                <?php      
                   echo "<option value='tous'> Tous les continents</option>";
                   foreach($lesContinents as $continent){
                        
                        $selection = ' $continent->getNum() ' == $continentSel ? 'selected' : '';
                        echo " 
                        <option value='" . $continent->getNum() . "'". $selection.">". $continent->getLibelle() ."</option>
                        
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

    foreach($lesNationalites as $nationalite){
        
        echo "<tr>";
        echo "<td>$nationalite->numero</td>";
        echo "<td>$nationalite->libNation</td>";
        echo "<td>$nationalite->libContinent</td>";
        echo"
        
        <td>
        <a href='formNationalite.php?action=Modifier&num=$nationalite->numero'>
        <img src='Image/modifier.png'>
        </a>
            
            <a href='#modalSupression' data-toggle='modal'  data-suppression='supprimerNationalite.php?num=$nationalite->numero'>
            
            <img src='Image/supprimer.png'>
            
            </a>
            
            </td>
            </tr>
            
            ";
            
            
            
    }
        
    ?>
    </form>
</div>