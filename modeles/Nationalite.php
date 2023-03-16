<?php 

class Nationalite{

    
    /** numéro du nationalite
     * @var int
     */

        private $num;
        public function getNum()
        {
            return $this->num;
        }
        

        
        private $libelle;
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

        private $numContinent;

        /**
         * Get the value of numContinent
         */
        public function getNumContinent()
        {
                return $this->numContinent;
        }

        /**
         * Set the value of numContinent
         *
         * @return  self
         */
        public function setNumContinent($numContinent)
        {
                $this->numContinent = $numContinent;

                return $this;
        }
        

        /**
         * 
         * @return Nationalite[] 
         * 
         */


        public static function findAll() : array
        {

            $req = MonPdo :: getInstance()-> prepare("Select * from nationalite");
            $req -> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Nationalite');
            $req -> execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;

        }


        /**
         * Trouve un continent par son num
         * 
         * @param integer $id
         * @return Continent objet Continent trouvé
         * 
         */

        public static function findById(int $id) : Nationalite
        {

            $req = MonPdo :: getInstance()-> prepare("Select * from continent where num =id");
            $req -> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Nationalite');
            $req -> bindParam(':id',$id);
            $req -> execute();
            $leResultats=$req->fetch();
            return $leResultats;

        }
        /**
         * Undocumented function
         *AJouter
         * @param Nationalite $nationalite continent à ajouter
         * @return integer resultat (1 si l'opération à réussi);
         * 
         */

        public static function add(Nationalite $nationalite) :int   
        {

            $req = MonPdo :: getInstance()-> prepare("Insert into nationalite (libelle) values(:libelle)");
            $req -> bindParam(':libelle',$nationalite->getLibelle());
            $nb=$req -> execute();
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

            $req = MonPdo :: getInstance()-> prepare("update nantionalite set libelle = :libelle where num = :id");
            $req -> bindParam(':id',$nationalite->getNum());
            $req -> bindParam(':libelle',$nationalite->getLibelle());
            $nb=$req -> execute();
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
