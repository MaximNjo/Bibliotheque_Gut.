<?php 

class Continent{

    
        private $num;
        /** numéro contineny
        * @var int
        */
        public function getNum()
        {
            return $this->num;
        }
        

        
        private $libelle;
        /**
         * Lit le libelle
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
         * @return Continent[] 
         * 
         */


        public static function findAll() : array
        {

            $req = MonPdo :: getInstance()-> prepare("Select * from continent");
            $req -> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
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

        public static function findById(int $id) : Continent
        {

            $req = MonPdo :: getInstance()-> prepare("Select * from continent where num =id");
            $req -> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
            $req -> bindParam(':id',$id);
            $req -> execute();
            $leResultats=$req->fetch();
            return $leResultats;

        }
        /**
         * Undocumented function
         *AJouter
         * @param Continent $continent continent à ajouter
         * @return integer resultat (1 si l'opération à réussi);
         * 
         */

        public static function add(Continent $continent) :int   
        {

            $req = MonPdo :: getInstance()-> prepare("Insert into continent (libelle) values(:libelle)");
            $req -> bindParam(':libelle',$continent->getLibelle());
            $nb=$req -> execute();
            return $nb;

        }

         /**
         * Undocumented function
         *Modifier
         * @param Continent $continent continent à modifier
         * @return integer resultat (1 si l'opération à réussi, 0 sinon);
         * 
         */

        public static function update(Continent $continent) :int  
        {

            $req = MonPdo :: getInstance()-> prepare("update continent set libelle = :libelle where num = :id");
            $req -> bindParam(':id',$continent->getNum());
            $req -> bindParam(':libelle',$continent->getLibelle());
            $nb=$req -> execute();
            return $nb;


        }

         /**
         * Undocumented function
         * Suppprimer
         * @param Continent $continent 
         * @return integer resultat 
         * 
         */
        

        public static function delete(Continent $continent) :int
        {

            $req = MonPdo :: getInstance()-> prepare("delete from continent where num = :id");
            $req -> bindParam(':id',$continent->getNum());
            $nb=$req -> execute();
            return $nb;



        }


}



?>
