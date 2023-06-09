<?php
    namespace Models;
    class Person{
        protected static $conn;
        protected static $columnsTbl=['id_person','firstname_person','lastname_person','birthday_person','id_city'];
        private $id_city;
        private $id_person;

        private $lastname_person;

        private $birthday_person;
        
        private $firstname_person;

        public function __construct($args = []){
            $this->id_city = $args['id_city'] ?? '';
            $this->firstname_person = $args['firstname_person'] ?? '';
            $this->id_person = $args['id_person'] ?? '';
            $this->lastname_person = $args['lastname_person'] ?? '';
            $this->birthday_person = $args['birthday_person'];


        }
        public function saveData($data){
            $delimiter = ":";
            $dataBd = $this->sanitizarAttributos();
            $valCols = $delimiter . join(',:',array_keys($data));
            $cols = join(',',array_keys($data));
            $sql = "INSERT INTO Person ($cols) VALUES ($valCols)";
            $stmt= self::$conn->prepare($sql);
            $stmt->execute($data);
        }
        public function loadAllData(){
            $sql = "SELECT id_city,firstname_person,lastname_person,birthday_person,id_person FROM Person";
            $stmt= self::$conn->prepare($sql);
            //$stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $stmt->execute();
            $clientes = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $clientes;
        }
        public function loadDataById($id){
            $sql = "SELECT id_city,firstname_person,lastname_person,birthday_person,id_person FROM Person where id_person = :id_person" ;
            $stmt= self::$conn->prepare($sql);
            //$stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $stmt->bindparam("id_person", $id, \PDO::PARAM_INT);
            $stmt->execute();
            $clientes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $clientes;
        }
        public static function setConn($connBd){
            self::$conn = $connBd;
        }
        public function atributos(){
            $atributos = [];
            foreach (self::$columnsTbl as $columna){
                if($columna === 'id_person') continue;
                $atributos [$columna]=$this->$columna;
             }
             return $atributos;
        }
        public function sanitizarAttributos(){
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach($atributos as $key => $value){
                $sanitizado[$key] = self::$conn->quote($value);
            }
            return $sanitizado;
        }
    }
?>