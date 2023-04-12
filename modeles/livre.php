<?php 

class Livre{
   
    private $num;
    private $numAuteur;
    private $libelle;

    // Getter de num
    public function getNum()
    {
        return $this->num;
    }

    // Setter de num
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }



    public function numAuteur(): int
    {
        return $this->numAuteur;
    }

  
    public function getAuteur() :Auteur
    {
        return Auteur::findById($this->numAuteur);
    }


    public function setAuteur(Auteur $continent) :self
    {
        $this->numAuteur = $continent->getNum();

        return $this;
    }
    
    // GETTER LIBELLE
    public function getLibelle()
    {
        return $this->libelle;
    }


    //  SETTER LIBELLE
    public function setLibelle($libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Retourne les nationalités
     * @return Livre[] 
     * 
     */


    public static function findAll(?string $auteur ="Tous") : array
    {
        
        $texteReq = "select l.num as numero, l.isbn as 'isbn' ,l.titre as 'titre', l.prix as 'prix', l.editeur as 'editeur', l.annee as 'annee', l.langue as 'langue' from livre l, livre a where a.numAuteur=a.num";

        
        if($auteur != "Tous"){ 
            $texteReq .= " and a.numAuteur =" .$auteur;

        }
        $req = MonPdo::getInstance()->prepare($texteReq);
        $req -> setFetchMode(PDO::FETCH_OBJ);
        $req -> execute();
        $lesResultats = $req -> fetchAll();
        return $lesResultats;

    }


    /**
     * Trouve un Nationalité par son num
     * 
     * @param integer $id
     * @return Livre objet Livre trouvé
     * 
     */

        public static function findById(int $id) : Livre
        {

        $req = MonPdo::getInstance()->prepare("select * from livre where num = :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Livre');
        $req->bindParam(':id', $id);
        $req->execute();
        $leResultat = $req->fetch();
        return $leResultat;
        
        }
        
    /**
     * Undocumented function
     *AJouter
        * @param Livre $livre continent à ajouter
        * @return integer resultat (1 si l'opération à réussi);
        * 
        */

        public static function add(Livre $livre): int {

        $req = MonPdo::getInstance()->prepare("Insert into livre (nom,prenom,numAuteur) values(:nom, :prenom, :numAuteur)");
        $nom = $livre->getNom();
        $prenom = $livre->getPrenom();
        $numCont = $livre->numAuteur();
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':numAuteur', $numCont);
        $nb = $req->execute();
        return $nb;
    }

        /**
     * Undocumented function
     *Modifier
        * @param Livre $Livre continent à modifier
        * @return integer resultat (1 si l'opération à réussi, 0 sinon);
        * 
        */

        public static function update(Livre $livre) :int  
        {
            $req = MonPdo::getInstance()->prepare("update livre set nom = :nom, prenom = :prenom, numAuteur=:numCont where num = :id");

            $id = $livre->getNum();
            $nom = $livre->getNom();
            $prenom = $livre->getPrenom();
            $numCont = $livre->numAuteur();

            $req->bindParam(':id', $id);
            $req->bindParam(':nom', $nom);
            $req->bindParam(':prenom', $prenom);
            $req->bindParam(':numCont', $numCont);
            $nb = $req->execute();
            return $nb;
        }

        /**
     * Undocumented function
     * Suppprimer
     * @param Livre $livre
     * @return integer resultat 
     * 
     */
    

    public static function delete(Livre $livre) :int
    {

        $req = MonPdo::getInstance()-> prepare("delete from livre where num = :id");
        $num = $livre->getNum();
        $req -> bindParam(':id',$num);
        $nb=$req -> execute();
        return $nb;

    }






}

