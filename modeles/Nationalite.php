<?php 

class Nationalite{

    
    /** numéro du nationalite
     * @var int
     */
    
        private $num;
        private $libelle;
        private $numContinent;


        public function getNum()
        {
            return $this->num;
        }

        // Constructor en php
        public function __construct($num, $libelle, $numContinent) {
            $this->num = $num;
            $this->libelle = $libelle;
            $this->numContinent = $numContinent;
        }

        
        /**
         * libelle du Nationalite
         * Get the value of libelle
         * *@var libelle
         */
        public function getLibelle() : string
        {
            return $this->libelle;
        }

        /**
         * Set the value of libelle
         *
         * @return  self
         */
        public function setLibelle(string $libelle) : self
        {
            $this->libelle = $libelle;

            return $this;
        }

        /**
         * 
         * num continent (clé étrangère) reliè à num de Continent
         * @var int
         */

        public function numContinent() :int
        {
            return $this->numContinent;
        }

        /**
         * Get the value of numContinent
         */
        public function getContinent(Continent $continent) :Continent
        {
            return Continent::findById($this->numContinent);
        }

        /**
         * Set the value of numContinent
         *
         * @return  self
         */
        public function setContinent(Continent $continent) :self
        {
            $this->numContinent = $continent->getNum();

            return $this;
        }
        

        /**
         * Retourne les nationalités
         * @return Nationalite[] 
         * 
         */


        public static function findAll(?string $libelle="", ?string $continent="Tous") : array
        {
            
            $texteReq = "select n.num as numero, n.libelle as 'libNation', c.libelle as 'libContinent' from nationalite n, continent c where n.numContinent=c.num";
            if($libelle != ""){
                $texteReq .= " and n.libelle like '%" . $libelle . "%'";
            }
            
            if($continent != "Tous"){ 
                $texteReq .= " and c.num =" .$continent;
            }
            $texteReq.= " order by n.libelle";
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
         * @return Nationalite objet Nationalite trouvé
         * 
         */

         public static function findById(int $id) : Nationalite
         {
             $req = MonPdo::getInstance()->prepare("SELECT * FROM nationalite WHERE num = :id");
             $req->bindParam(':id', $id);
             $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Nationalite');
             $req->execute();
             $leResultat = $req->fetch();
             return $leResultat;
         }
         
        /**
         * Undocumented function
         *AJouter
         * @param Nationalite $nationalite continent à ajouter
         * @return integer resultat (1 si l'opération à réussi);
         * 
         */

         public static function add(Nationalite $nationalite): int {
            $req = MonPdo::getInstance()->prepare("Insert into nationalite (libelle,numContinent) values(:libelle, :numContinent)");
            $lib = $nationalite->getLibelle();
            $numCont = $nationalite->numContinent();
            $req->bindParam(':libelle', $lib);
            $req->bindParam(':numContinent', $numCont);
            $nb = $req->execute();
            return $nb;
        }

         /**
         * Undocumented function
         *Modifier
         * @param Nationalite $Nationalite continent à modifier
         * @return integer resultat (1 si l'opération à réussi, 0 sinon);
         * 
         */

         public static function update(Nationalite $nationalite) :int  
         {
             $req = MonPdo::getInstance()->prepare("update nationalite set libelle = :libelle, numContinent=:numContinent where num = :id");
             $req->bindParam(':id', $nationalite->getNum());
             $req->bindParam(':libelle', $nationalite->getLibelle());
             $req->bindParam(':numContinent', $nationalite->numContinent());
             $nb = $req->execute();
             return $nb;
         }

         /**
         * Undocumented function
         * Suppprimer
         * @param Nationalite $nationalite
         * @return integer resultat 
         * 
         */
        

        public static function delete(Nationalite $nationalite) :int
        {

            $req = MonPdo :: getInstance()-> prepare("delete from nationalite where num = :id");
            $req -> bindParam(':id',$nationalite->getNum());
            $nb=$req -> execute();
            return $nb;



        }


}



?>
