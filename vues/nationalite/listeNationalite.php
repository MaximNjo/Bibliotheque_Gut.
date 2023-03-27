<div class="container">

    <!-- Titre + btn ajout nationalité -->
    <div class="row">
        <div class="col-9">

            <h2>Listes des Nationalités</h2>
            
        </div>
        <div class="col-3">

            <a href="index.php?uc=nationalites&action=Ajouter" class="btn btn-sucess">

                <img src="image/plus.png"> Créer une Nationalité
                
            </a>

        </div>
    </div>


    <br>

    <!-- FORMULAIRE -->

    <form id="formRecherche" action="index.php?uc=nationalites&action=list" method="post">

                <div class="formNat">
                <div class="row">
                    <!-- Champs Saisir libelle -->
                    <div class="col">
                        
                        <input type="text" class="form-control" id="libelle" onInput="document.getElementById('formRecherche').submit()" placeholder="Saisir le libellé" name="libelle"  value= "<?php echo $libelle; ?>">
                        
                    </div>
                    <!-- Listes déroulantes des Continents -->
                    <div class="col">
                           
                        <select name="continent" class="form-control" onChange="document.getElementById('formRecherche').submit()">
                            <?php      
                            
                                echo "<option value='Tous'> Tous les continents</option>";
                                foreach($lesContinents as $continent){
                                    
                                    $selection = ' $continent->getNum() ' == $continentSel ? 'selected' : '';
                                    echo " 

                                     <option value='" . $continent->getNum() . "'". $selection.">". $continent->getLibelle() ."</option>
                                    
                                    ";
                                        
                                }
                            ?>
                    </select>

                </div>
                <!-- BUTTON RECHERCHER-->
                <div class="col">
                    
                    <button type="submit" class="btn btn-success">Rechercher</button>
                    
                </div>
              </div>
            </div>    
        </form>
        
                <!-- AFFICHAGE  -->
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
        
                    // Affichage des Nationalités
        
                    foreach($lesNationalites as $nationalite){
                        
                        echo "<tr>";
                        echo "<td>$nationalite->numero</td>";
                        echo "<td>$nationalite->libNation</td>";
                        echo "<td>$nationalite->libContinent</td>";
                        echo"
                            <td>
        
                                <a href='formNationalite.php?action=Modifier&num=$nationalite->numero'>
                                    <img src='image/modifier.png'>
                                </a>
                                
                                <a href='#modalSupression' data-toggle='modal'  data-suppression='supprimerNationalite.php?num=$nationalite->numero'>
                                <img src='image/supprimer.png'>
                                </a>
                            
                            </td>
                          </tr>
                            
                        ";          
                            
                    }
                    
                ?>
</div>