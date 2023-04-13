<?php 

$action = $_GET['action'];
switch ($action){

    case 'list':
        // Traitement du formulaire de recherche 
        $auteurSel="Tous";
        if (!empty($_POST['auteur'])){
            
            $auteurSel = $_POST['auteur'];
        }

        $genreSel="Tous";
        if (!empty($_POST['genre'])){
            
            $genreSel = $_POST['genre'];
        }

        $lesAuteurs = Auteur::findAllAut();
        $lesGenres = Genre::findAll();
        $lesLivres = Livre::findAll($auteurSel, $genreSel);
        include('vues/livre/listeLivre.php');
    break;
    case 'add' : 
        $mode = "Ajouter";
        $lesNationalites = Nationalite::findAllNat();
        include("vues/livre/formLivre.php");
    break;
    case 'update' :
        $mode = "Modifier";
        $lesNationalites = Nationalite::findAllNat();
        $livre = Livre::findById($_GET['num']);
        include("vues/livre/formLivre.php");
    break;
    case 'delete' :

        $livre = Livre::findById($_GET['num']);
        $nb = Livre::delete($livre);

        if ($nb == 1) {
            
            $_SESSION['message']=["sucess" => "Le livre a bien été supprimé "];

        } else {
            
            $_SESSION['message']=["danger" => "Le livre n'a pas été supprimer "];
        }
        
        header("location: index.php?uc=livres&action=list");
        exit();
    break;
    case 'validForm' :

        $livre = new Livre();
        $auteur = Nationalite::findById($_POST['auteur']);
        if (empty($_POST['num'])) {
            
            $livre->setNom($_POST['nom'])
                   ->setPrenom($_POST['prenom'])
                   ->setNationalite($auteur);
            $nb = Livre::add($livre);
            $message = 'ajouté';

        }else { 

            $livre->setNum($_POST['num'])
                   ->setNom($_POST['nom'])
                   ->setPrenom($_POST['prenom'])
                   ->setNationalite($auteur);
            $nb = Livre::update($livre);
            $message = 'modifié';
        }
        // Si sa c'est bien passéS
        if ($nb == 1) {
            
            $_SESSION['message']=["sucess"=>"Le livre a bien été $message "];

        } else {
            
            $_SESSION['message']=["danger"=>"Le livre a bien été $message "];

        }

        header("location: index.php?uc=livres&action=list");
        exit();
    break;
    
}

