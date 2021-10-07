<?php

class Student{

    // DB Stuff
    private $conn;
    private $table = 'students';


   // Student Properties
    public $id;
    public $name;
    public $age;
    public $gender;
    public $email_address;


    // Constructor with DB
    public function __construct($db) {
      
        //set connection of this class to the db
        $this->conn = $db;
    }

    // GET Student

    public function read() {
      
        //create query
        $query =  "SELECT id, name,age,gender, email_address FROM " . $this->table . "";
        
        // prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        // return statement
        return $stmt;        
    }


    // READ Single
    public function read_single() {
    
        // create query
        $query = "SELECT
        id, 
        name, 
        age, 
        gender,
        email_address  
        
      FROM
        ". $this->table ."
    WHERE 
       id = ?
    LIMIT 0,1";

    //Prepare Statement
     $stmt = $this->conn->prepare($query);
     

    //  Eind ID to this ?
     $stmt->bindParam(1,$this->id);

       //execute query
      $stmt->execute();

      //Fetch data from query
       $row = $stmt->fetch(PDO::FETCH_ASSOC);

      //Set Properties
      $this->name = $row['name'];
      $this->age = $row['age'];
      $this->gender = $row['gender'];
      $this->email_address = $row['email_address'];

    }

    // create Student

    public function create(){

        // create query
        $query = "INSERT INTO
        ". $this->table ."
    SET
        name = :name,  
        age = :age,
        gender = :gender, 
        email_address = :email_address";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->email_address=htmlspecialchars(strip_tags($this->email_address));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(':gender',$this->gender);
        $stmt->bindParam(":email_address", $this->email_address);
        
        // Execute query
        if($stmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error); 
        return false;
        
    }


    // Update Student
    
    public function update(){

        // create query
        $query = "UPDATE
        ". $this->table ."
    SET
        name = :name,  
        age = :age,
        gender = :gender, 
        email_address = :email_address
    WHERE
        id =:id";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->age=htmlspecialchars(strip_tags($this->age));
         $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->email_address=htmlspecialchars(strip_tags($this->email_address));
        $this->id= htmlspecialchars_decode(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(':gender',$this->gender);
        $stmt->bindParam(":email_address", $this->email_address);
        $stmt->bindParam(":id", $this->id);
        
        // Execute query
        if($stmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error); 
        return false;
    }


    // Delete Student
    public function delete(){
        // create query
        $query = "DELETE FROM
        ". $this->table ."
    WHERE
        id =:id";

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id= htmlspecialchars_decode(strip_tags($this->id));

        //Bind ID
        $stmt->bindParam("id",$this->id);
        
        // Execute query
        if($stmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error); 
        return false;
        
    }

}

?>

