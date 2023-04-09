<?php 

class Auteur{
   
    private $num;
    private $nom;
    private $prenom;
    private $numNationalite;
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

    // GETTER NOM
    public function getNom()
    {
        return $this->nom;
    }
    // SETTER NOM
    public function setNom($nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    // GET PRENOM
    public function getPrenom()
    {
        return $this->prenom;
    }
    // PRENOM
    public function setPrenom($prenom): self
    {
        $this->prenom = $prenom;

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


    public function setNationalite(Nationalite $continent) :self
    {
        $this->numNationalite = $continent->getNum();

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
     * @return Auteur[] 
     * 
     */


    public static function findAll(?string $nom="", ?string $prenom="", ?string $nationalite ="Tous") : array
    {
        
        $texteReq = "select a.num as numero, a.nom as 'nom', a.prenom as 'prenom', n.libelle as 'libNationalite' from auteur a, nationalite n where a.numNationalite=n.num";

        if($nom != ""){
            $texteReq .= " and a.nom like '%" . $nom . "%'";
        }
        if($prenom != ""){
            $texteReq .= " and a.prenom like '%" . $prenom . "%'";
        }
        
        if($nationalite != "Tous"){ 
            $texteReq .= " and a.numNationalite =" .$nationalite;

        }
        $texteReq.= " order by numero";
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
        * @param Auteur $auteur continent à ajouter
        * @return integer resultat (1 si l'opération à réussi);
        * 
        */

        public static function add(Auteur $auteur): int {

        $req = MonPdo::getInstance()->prepare("Insert into auteur (nom,prenom,numNationalite) values(:nom, :prenom, :numNationalite)");
        $nom = $auteur->getNom();
        $prenom = $auteur->getPrenom();
        $numCont = $auteur->numNationalite();
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':numNationalite', $numCont);
        $nb = $req->execute();
        return $nb;
    }

        /**
     * Undocumented function
     *Modifier
        * @param Auteur $Auteur continent à modifier
        * @return integer resultat (1 si l'opération à réussi, 0 sinon);
        * 
        */

        public static function update(Auteur $auteur) :int  
        {
            $req = MonPdo::getInstance()->prepare("update auteur set nom = :nom, prenom = :prenom, numNationalite=:numCont where num = :id");

            $id = $auteur->getNum();
            $nom = $auteur->getNom();
            $prenom = $auteur->getPrenom();
            $numCont = $auteur->numNationalite();

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

