<?php 

$action = $_GET['action'];
switch ($action){

    case 'list':
        // Traitement du formulaire de recherche 
        $libelle = "";
        $continentSel="Tous";
        if (!empty($_POST['libelle']) || !empty($_POST['continent'])){
            
            $libelle = $_POST['libelle'];
            $continentSel = $_POST['continent'];
        }
        $lesContinents = Continent::findAll();
        $lesAuteurs = Auteur::findAll($libelle, $continentSel);
        include('vues/auteur/listeAuteur.php');
    break;
    case 'add' : 
        $mode = "Ajouter";
        $lesContinents = Continent::findAll();
        include("vues/auteur/formAuteur.php");
    break;
    case 'update' :
        $mode = "Modifier";
        $lesContinents = Continent::findAll();
        $auteur = Auteur::findById($_GET['num']);
        include("vues/auteur/formAuteur.php");
    break;
    case 'delete' :
        

        $auteur = Auteur::findById($_GET['num']);
        $nb = Auteur::delete($auteur);

        if ($nb == 1) {
            
            $_SESSION['message']=["sucess" => "Le auteur a bien été supprimé "];

        } else {
            
            $_SESSION['message']=["danger" => "Le auteur n'a pas été supprimer "];
        }
        
        header("location: index.php?uc=auteurs&action=list");
        exit();
    break;
    case 'validForm' :

        $auteur = new Auteur();
        $continent = Continent::findById($_POST['continent']);
        if (empty($_POST['num'])) {
            
            $auteur->setLibelle($_POST['libelle'])
                        ->setContinent($continent);
            $nb = Auteur::add($auteur);
            $message = 'ajouté';

        }else { 

            $auteur->setNum($_POST['num'])
                        ->setLibelle($_POST['libelle'])
                        ->setContinent($continent)       
                        ;
            $nb = Auteur::update($auteur);
            $message = 'modifié';
        }
        // Si sa c'est bien passéS
        if ($nb == 1) {
            
            $_SESSION['message']=["sucess"=>"La nationalité a bien été $message "];

        } else {
            
            $_SESSION['message']=["danger"=>"La nationalité a bien été $message "];

        }

        header("location: index.php?uc=auteurs&action=list");
        exit();
    break;
    
}

