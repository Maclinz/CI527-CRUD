<?php 

    class Db{
        //Db Parameters
        private $host = 'localhost';
        private $db_name = 'comments';
        private $username = 'root';
        private $password = '';
        private $connection;

        //Connect To Database
        public function connect(){
            $this->connection = null;

            try{
                $this->connection = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->db_name, $this->username, $this->password );
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $ex){
                echo 'There was an Error Connecting to the Database' . $ex->getMessage();
            }

            return $this->connection;
        }
    }

?>