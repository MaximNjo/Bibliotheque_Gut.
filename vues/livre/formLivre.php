<div class="container">

    <h2 class="titreH2"> <?php echo $mode ?> un livre </h2>

    <div class="formulaire"> 
            <form action="index.php?uc=livres&action=validForm" method="post">

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" placeholder="Saisir le nom" name="nom" value="<?php if ($mode == 'Modifier' && isset($livre)) {
                    echo $livre->getNom();
                } ?>">
            </div>

            <div class="form-group">
                <label for="nom">Prenom</label>
                <input type="text" class="form-control" id="prenom" placeholder="Saisir le prenom" name="prenom" value="<?php if ($mode == 'Modifier' && isset($livre)) {
                    echo $livre->getPrenom();
                } ?>">
            </div>
            
            <!-- CONTINENT -->
            <div class="form-group">
                <label for="auteur">Auteur</label>
                <select name="auteur" class="form-control">
                    <?php foreach ($lesAuteurs as $auteur) {
                        $selection = '';
                        if ($mode == 'Modifier' && isset($livre)) {
                            $selection = $auteur->getNum() == $livre->getAuteur()->getNum() ? 'selected' : '';
                        }
                        echo "<option value='" . $auteur->getNum() . "'" . $selection . ">" . $auteur->getLibelle() . "</option>";
                    } ?>
                </select>
            </div>
            
            <input type="hidden" id="num" name="num" value="<?php if ($mode == 'Modifier' && isset($livre)) {
                echo $livre->getNum();
            } ?>" >

            <br>

            <div class="row">
                <div class="col"> 
                    <a href="index.php?uc=livres&action=list" class="btn nat">Revenir à la listes</a>
                    &nbsp;&nbsp;&nbsp;
                    <button type="submit"><?php echo $mode; ?></button>
                </div>
            </div>
        </form>
        
        
    </div>
</div>