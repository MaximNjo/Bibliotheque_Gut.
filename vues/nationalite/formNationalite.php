<div class="container">
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