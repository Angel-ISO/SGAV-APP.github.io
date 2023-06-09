<?php
    namespace Models;
    class Cities{
        protected static $conn;
        protected static $columnsTbl=['id_city','name_city','id_region'];
        private $id_city;
        private $name_city;
        
        private $id_region;
        public function __construct($args = []){
            $this->id_city = $args['id_city'] ?? '';
            $this->name_city = $args['name_city'] ?? '';
            $this->id_region = $args['id_region'] ?? '';
        }
        public function saveData($data){
            $delimiter = ":";
            $dataBd = $this->sanitizarAttributos();
            $valCols = $delimiter . join(',:',array_keys($data));
            $cols = join(',',array_keys($data));
            $sql = "INSERT INTO Cities ($cols) VALUES ($valCols)";
            $stmt= self::$conn->prepare($sql);
            $stmt->execute($data);
        }
        public function loadAllData(){
            $sql = "SELECT id_city,name_city,id_region FROM Cities";
            $stmt= self::$conn->prepare($sql);
            //$stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $stmt->execute();
            $clientes = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $clientes;
        }
        public function loadDataById($id){
            $sql = "SELECT id_city,name_city,id_region FROM Cities where id_city = :id_city" ;
            $stmt= self::$conn->prepare($sql);
            //$stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $stmt->bindparam("id_City", $id, \PDO::PARAM_INT);
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
                if($columna === 'id_city') continue;
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