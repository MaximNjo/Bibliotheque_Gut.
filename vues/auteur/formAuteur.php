<div class="container">

    <h2 class="titreH2"> <?php echo $mode ?> un auteur </h2>

    <div class="formulaire"> 
            <form action="index.php?uc=auteurs&action=validForm" method="post">

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" placeholder="Saisir le nom" name="nom" value="<?php if ($mode == 'Modifier' && isset($auteur)) {
                    echo $auteur->getLibelle();
                } ?>">
            </div>

            <div class="form-group">
                <label for="nom">Prenom</label>
                <input type="text" class="form-control" id="prenom" placeholder="Saisir le prenom" name="prenom" value="<?php if ($mode == 'Modifier' && isset($auteur)) {
                    echo $auteur->getLibelle();
                } ?>">
            </div>
            
            <!-- CONTINENT -->
            <div class="form-group">
                <label for="continent">Nationalite</label>
                <select name="continent" class="form-control">
                    <?php foreach ($lesContinents as $continent) {
                        $selection = '';
                        if ($mode == 'Modifier' && isset($auteur)) {
                            $selection = $continent->getNum() == $auteur->getContinent()->getNum() ? 'selected' : '';
                        }
                        echo "<option value='" . $continent->getNum() . "'" . $selection . ">" . $continent->getLibelle() . "</option>";
                    } ?>
                </select>
            </div>
            
            <input type="hidden" id="num" name="num" value="<?php if ($mode == 'Modifier' && isset($auteur)) {
                echo $auteur->getNum();
            } ?>" >

            <br>

            <div class="row">
                <div class="col"> 
                    <a href="index.php?uc=auteurs&action=list" class="btn nat">Revenir à la listes</a>
                    &nbsp;&nbsp;&nbsp;
                    <button type="submit"><?php echo $mode; ?></button>
                </div>
            </div>
        </form>
        
        
    </div>
</div>