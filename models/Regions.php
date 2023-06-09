<?php
    namespace Models;
    class Regions{
        protected static $conn;
        protected static $columnsTbl=['id_region','name_region','id_country'];
        private $id_country;
        private $name_region;
        
        private $id_region;
        public function __construct($args = []){
            $this->id_country = $args['id_city'] ?? '';
            $this->name_region = $args['name_region'] ?? '';
            $this->id_region = $args['id_region'] ?? '';
        }
        public function saveData($data){
            $delimiter = ":";
            $dataBd = $this->sanitizarAttributos();
            $valCols = $delimiter . join(',:',array_keys($data));
            $cols = join(',',array_keys($data));
            $sql = "INSERT INTO Regions ($cols) VALUES ($valCols)";
            $stmt= self::$conn->prepare($sql);
            $stmt->execute($data);
        }
        public function loadAllData(){
            $sql = "SELECT id_country,name_region,id_region FROM Regions";
            $stmt= self::$conn->prepare($sql);
            //$stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $stmt->execute();
            $clientes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $clientes;
        }

        public function loadDataById($id){
            $sql = "SELECT id_country,name_region,id_region FROM Regions where id_region = :id_region" ;
            $stmt= self::$conn->prepare($sql);
            //$stmt->setFetchMode(\PDO::FETCH_ASSOC);
            $stmt->bindparam("id_region", $id, \PDO::PARAM_INT);
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
                if($columna === 'id_region') continue;
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