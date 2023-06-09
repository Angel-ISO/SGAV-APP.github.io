<?php
    namespace Models;
    class Living_place{
        protected static $conn;
        protected static $columnsTbl=['id_living','id_person','id_city','rooms_living','bathrooms_living','kitchen_living','tvroom_living','patio_living','pool_living','barbecue_living','image_living','id_typehouse'];
        private $id_living;
        private $id_person;
        private $id_city;
        private $rooms_living;
        private $bathrooms_living;
        private $kitchen_living;
        private $tvroom_living;
        private $patio_living;
        private $pool_living;
        private $barbecue_living;
        private $image_living;
        private $id_typehouse;

        public function __construct($args = []){
            $this->id_living = $args['id_living'] ?? '';
            $this->id_person = $args['id_person'] ?? '';
            $this->id_city = $args['id_city'] ?? '';
            $this->rooms_living = $args['rooms_living'] ?? '';
            $this->id_city = $args['bathrooms_living'] ?? '';
            $this->id_city = $args['kitchen_living'] ?? '';
            $this->id_city = $args['tvroom_living'] ?? '';
            $this->id_city = $args['patio_living'] ?? '';
            $this->id_city = $args['pool_living'] ?? '';
            $this->id_city = $args['barbecue_living'] ?? '';
            $this->id_city = $args['image_living'] ?? '';
            $this->id_city = $args['id_typehouse'] ?? '';
     
            
        }

        public function saveData($data){
            $delimiter = ":";
            $dataBd = $this->sanitizarAttributos();
            $valCols = $delimiter . join(',:',array_keys($data));
            $cols = join(',',array_keys($data));
            $sql = "INSERT INTO living_place ($cols) VALUES ($valCols)";
            $stmt= self::$conn->prepare($sql);
            $stmt->execute($data);
        }
        public function loadAllData(){
            $sql = "SELECT id_living,id_person,id_city,rooms_living,bathrooms_living,kitchen_living,tvroom_living,patio_living,pool_living,barbecue_living,image_living,id_typehouse FROM living_place";
            $stmt= self::$conn->prepare($sql);
            $stmt->execute();
            $paises = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $paises;
        }
        public function loadByIdData($id){
            $sql = "SELECT id_living,id_person,id_city,rooms_living,bathrooms_living,kitchen_living,tvroom_living,patio_living,pool_living,barbecue_living,image_living,id_typehouse FROM living_place WHERE id_living = :id_living";
            $stmt= self::$conn->prepare($sql);
            $stmt->bindParam(':id_living', $id, \PDO::PARAM_INT); 
            $stmt->execute();
            $pais = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $pais;
        }
        public function deleteByIdData($id){
            $response=[];
            $sql = "DELETE FROM living_place WHERE id_living = :id_living";
            $stmt= self::$conn->prepare($sql);
            $stmt->bindParam(':id_living', $id, \PDO::PARAM_INT); 
            $stmt->execute();
            if ($stmt->rowCount()>0){
                $response=[[
                    'mensaje' => 'El registro fue eliminado correctamente',
                    'codEstado' => '200',
                    'totalreg' => $stmt->rowCount()
                ]];
            }else{
                $response=[[
                    'mensaje' => 'El registro no fue eliminado',
                    'reject' => 'Registro no encontrado o no existe',
                    'codEstado' => '204',
                    'totalreg' => $stmt->rowCount()
                ]];
            }
            return $response;
        }
        public static function setConn($connBd){
            self::$conn = $connBd;
        }
        public function atributos(){
            $atributos = [];
            foreach (self::$columnsTbl as $columna){
                if($columna === 'id_living') continue;
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