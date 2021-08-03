<?php 

    class Post{
        private $connection;
        private $table = 'posts';
        

        //Post Properties
        public $id;
        public $name;
        public $comment;

        //Constructor to run automatically after Class instanciation
        public function __construct($db)
        {
            $this->connection = $db;
        }

        //Get Posts
        public function readData(){
            //Create Query
            //p is just an Alias to make the code shorter
            $query = 'SELECT p.id, p.name, p.comment FROM '. $this->table .' p ' ;

            //Prepare Statements
            $statement = $this->connection->prepare($query);

            //Execute Querry
            $statement->execute();

            return $statement;
        }

        //Get Individual Post
        public function readSinglePost(){
            $query = 'SELECT p.id, p.name, p.comment FROM '. $this->table .' p WHERE p.id = ? LIMIT 0,1' ;

            //Prepare Statement
            $statement = $this->connection->prepare($query);

            //Bind Id
            $statement->bindParam(1, $this->id);
            //Execute Querry
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);
            //Set Properties from returned data
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->comment = $row['comment'];
        }

        //Creat Post Method
        public function createPost(){
            $query = 'INSERT INTO ' . $this->table . '
                SET id = :id, name = :name, comment = :comment 
            ' ;

            //Prepare Statement
            $statement = $this->connection->prepare($query);

            //Clean The data and check if its correct and secure
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->comment = htmlspecialchars(strip_tags($this->comment));

            //Bind Data
            $statement->bindParam(':id', $this->id);
            $statement->bindParam(':name', $this->name);
            $statement->bindParam(':comment', $this->comment);

            //Execute Query
            if($statement->execute()){
                //Return true if the statement executes
                return true;
            }
            //else Return Extra data 
            printf("Error: %. \n", $statement->error);
            return false;
            }


        //Update Post Method
        public function udpatePost(){
            $query = 'UPDATE ' . $this->table . '
                SET id = :id, name = :name, comment = :comment WHERE id = :id
            ' ;

            //Prepare Statement
            $statement = $this->connection->prepare($query);

            //Clean The data and check if its correct and secure
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->comment = htmlspecialchars(strip_tags($this->comment));

            //Bind Data
            $statement->bindParam(':id', $this->id);
            $statement->bindParam(':name', $this->name);
            $statement->bindParam(':comment', $this->comment);

            //Execute Query
            if($statement->execute()){
                //Return true if the statement executes
                return true;
            }
            //else Return Extra data 
            printf("Error: %. \n", $statement->error);
            return false;
            }

        //Delete Post
        public function deletePOST(){
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            //Prepare Statement
            $statement = $this->connection->prepare($query);

            //Clean the data
            $this->id = htmlspecialchars(strip_tags($this->id));
            //Bind Data
            $statement->bindParam(':id', $this->id);

            //Execute Query
            if($statement->execute()){
                //Return true if the statement executes
                return true;
            }
            //else Return Extra data 
            printf("Error: %. \n", $statement->error);
            return false;
        }
    }


    

?>