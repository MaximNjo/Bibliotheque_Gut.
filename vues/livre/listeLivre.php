<div class="container">

    <!-- Titre + btn ajout nationalité -->
    <div class="row">
        <div class="col-9">

            <h2>Listes des Livres</h2>
            
        </div>
        <div class="col-3">

            <a href="index.php?uc=livres&action=add" class="btn btn-sucess">

                <img src="image/plus.png"> Créer un Livre
                
            </a>

        </div>
    </div>


    <br>

    <!-- FORMULAIRE -->

    <form id="formRecherche" action="index.php?uc=livres&action=list" method="post">

        <div class="formNat">
            <div class="row">
                    <!-- Champs Saisir libelle -->
                    <div class="col">
                        
                        <input type="text" class="form-control"  id="nom" onInput="document.getElementById('formRecherche').submit()" placeholder="Saisir le nom" name="nom"  value= "<?php echo $nom; ?>">
                        
                    </div>


   
                    <div class="col">  
                        <select name="auteur" class="form-control" onChange="document.getElementById('formRecherche').submit()">
                            <?php      
                                
                                echo "<option value='Tous'> Tous les Auteurs </option>";
                                foreach($lesAuteurs as $auteur){
                                    
                                    $selection = $auteur->getNum() == intval($auteurSel) ? 'selected' : '';
                                    echo "<option value='" . $auteur->getNum() . "' ". $selection." >". $auteur->getLibelle() ."</option>";
                                        
                                }
                                

                               
                            ?>
                        </select>
                     </div>



                     <div class="col">  
                        <select name="auteur" class="form-control" onChange="document.getElementById('formRecherche').submit()">
                            <?php      
                                
                                echo "<option value='Tous'> Tous les Genres </option>";
                                foreach($lesAuteurs as $auteur){
                                    
                                    $selection = $auteur->getNum() == intval($auteurSel) ? 'selected' : '';
                                    echo "<option value='" . $auteur->getNum() . "' ". $selection." >". $auteur->getLibelle() ."</option>";
                                        
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
                <td class="col-md-2"><strong>Isbn</strong></td>
                <td class="col-md-2"><strong>Titre</strong></td>
                <td class="col-md-4"><strong>Prix</strong></td>
                <td class="col-md-3"><strong>Editeur</strong></td>
                <td class="col-md-3"><strong>Année</strong></td>
                <td class="col-md-3"><strong>Langue</strong></td>
                <td class="col-md-3"><strong>Auteurs</strong></td>
                <td class="col-md-3"><strong>Genres</strong></td>
                <td class="col-md-2"><strong>Actions</strong></td>
            </tr>
        </thead>
            
            
    <?php

        // Affichage des Nationalités

        foreach($lesLivres as $livre){
            
            echo "<tr>";
            echo "<td>$livre->isbn</td>";
            echo "<td>$livre->titre</td>";
            echo "<td>$livre->prix</td>";
            echo "<td>$livre->editeur</td>";
            echo "<td>$livre->annee</td>";
            echo "<td>$livre->langue</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo"
                <td>

                    <a href='index.php?uc=livres&action=update&num=".$livre->numero."'>
                        <img src='image/modifier.png'>
                    </a>
                    
                    <a href='#modalSupression' data-toggle='modal' data-message='Voulez-vous vraiment supprimer cette livre ?'  data-suppression='index.php?uc=livres&action=delete&num=".$livre->numero."' >
                    <img src='image/supprimer.png'>
                    </a>
                
                </td>
                </tr>
                
            ";          
                
        }
        
    ?>
</div>
