<?php 

class Auteur{
   
    private $num;
    private $libelle;
    private $numNationalite;

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

    // Getter de libelle
    public function getLibelle() : string
    {
        return $this->libelle;
    }

    // Setter de libelle
    public function setLibelle(string $libelle) : self
    {
        $this->libelle = $libelle;

        return $this;
    }

    
    public function numNationalite(): int
    {
        return $this->numNationalite;
    }

  
    public function getNationalite() :Nationalite
    {
        return Nationalite::findById($this->numNationalite);
    }


    public function setNationalite(Nationalite $Nationalite) :self
    {
        $this->numNationalite = $Nationalite->getNum();

        return $this;
    }
    
    

    /**
     * Retourne les nationalités
     * @return Auteur[] 
     * 
     */


    public static function findAll(?string $libelle="", ?string $nationalite="Tous") : array
    {
        
        $texteReq = "select a.num as numero, a.nom as 'nom', a.prenom as 'prenom', n.libelle as 'libNationalite' from auteur a, nationalite n where a.numNationalite=n.num";
        if($libelle != ""){
            $texteReq .= " and a.nom like '%" . $libelle . "%'";
        }
        
        if($nationalite != "Tous"){ 
            $texteReq .= " and c.num =" .$nationalite;
        }
        $texteReq.= " order by a.num";
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
     * @return Auteur objet Auteur trouvé
     * 
     */

        public static function findById(int $id) : Auteur
        {

        $req = MonPdo::getInstance()->prepare("select * from auteur where num = :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Auteur');
        $req->bindParam(':id', $id);
        $req->execute();
        $leResultat = $req->fetch();
        return $leResultat;
        
        }
        
    /**
     * Undocumented function
     *AJouter
        * @param Auteur $auteur Nationalite à ajouter
        * @return integer resultat (1 si l'opération à réussi);
        * 
        */

        public static function add(Auteur $auteur): int {

        $req = MonPdo::getInstance()->prepare("Insert into auteur (libelle,numNationalite) values(:libelle, :numNationalite)");
        $lib = $auteur->getLibelle();
        $numCont = $auteur->numNationalite();
        $req->bindParam(':libelle', $lib);
        $req->bindParam(':numNationalite', $numCont);
        $nb = $req->execute();
        return $nb;
    }

        /**
     * Undocumented function
     *Modifier
        * @param Auteur $Auteur Nationalite à modifier
        * @return integer resultat (1 si l'opération à réussi, 0 sinon);
        * 
        */

        public static function update(Auteur $auteur) :int  
        {
            $req = MonPdo::getInstance()->prepare("update auteur set libelle = :libelle, numNationalite=:numCont where num = :id");
            $id = $auteur->getNum();
            $lib = $auteur->getLibelle();
            $numCont = $auteur->numNationalite();
            $req->bindParam(':id', $id);
            $req->bindParam(':libelle', $lib);
            $req->bindParam(':numCont', $numCont);
            $nb = $req->execute();
            return $nb;
        }

        /**
     * Undocumented function
     * Suppprimer
     * @param Auteur $auteur
     * @return integer resultat 
     * 
     */
    

    public static function delete(Auteur $auteur) :int
    {

        $req = MonPdo::getInstance()-> prepare("delete from auteur where num = :id");
        $num = $auteur->getNum();
        $req -> bindParam(':id',$num);
        $nb=$req -> execute();
        return $nb;

    }


}

