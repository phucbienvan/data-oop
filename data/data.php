<?php

    class database {
        private $conn;
        // private $result;

        // ket noi database
        public function connect(){
            try {
                $this->conn = new PDO("mysql:host=localhost:3307;dbname=users", 'root', '');
                
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 
               
            } 
            // Nhánh kết nối thất bại
            catch (PDOException $e) {
                echo "Kết nối thất bại: " . $e->getMessage();
            }
        }

        // ngat ket noi database
        public function disconnect(){
            if($this->conn){
                $this->conn = null;
            }
        }

        // Ham insert
        public function insert($table, $data){
            
            try {
              
                $this->connect();
                $field_list = '';
                $value_list = '';
                // Cấu hình exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                foreach ($data as $key => $value){
                    $field_list .= ",$key";
                    $value_list .= ",'".$value."'";
                }
                $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
               
                return  $this->conn->exec($sql);
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
            }
             
        }

        // Ham update
        public function update($table, $data, $where){
            try {
              
                $this->connect();
                $sql = '';
                foreach ($data as $key => $value){
                    $sql .= "$key = '".$value."',";
                }
                $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
                return $this->conn->exec($sql);
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        // Ham delete
        public function delete($table, $where){
            try {
                $this->connect();
                $sql = "DELETE FROM $table WHERE $where";
                return $this->conn->exec($sql);
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        // Ham lay danh sach
        public function list($sql){
            try {
                $this->connect();
                $result = $this->conn->prepare("$sql");
                if(!$result){
                    die('Cau truy van sai');
                }
                // return array();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $return[] = $row; 
                }
                $result->closeCursor();
                return $return;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }


        // Ham lay 1 record
        public function get_row($sql){
            try {
                $this->connect();
                $result = $this->conn->prepare("$sql");
                if(!$result){
                    die('Cau truy van sai');
                }
                // return array();
                $result->execute();
                $row = $result->fetch(PDO::FETCH_ASSOC);
                
                $result->closeCursor();
                if ($row){
                    return $row;
                }
         
                return false;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }


}

?>
