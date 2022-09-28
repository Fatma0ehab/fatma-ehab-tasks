<?php

$db_server="localhost";
$db_user="root";
$db_password="";
$db_database="e-commerce";

$connection=mysqli_connect($db_server,$db_user,$db_password,$db_database);

// if($connection){
//     echo "true";
// }
// else{
//     echo "false";
// }






// namespace Connection;


// class Connection {
//     private string $dbName = 'e-commerce';
//     private string $hostName = 'localhost';
//     private string $username = 'root';
//     private string $password = '';
//     private int $DBport = 3307; 
//     protected \mysqli $conn;

//     public function __construct() {
//         $this->conn = new \mysqli($this->hostName,$this->username,$this->password,
//         $this->dbName,$this->DBport);
//         // if ($conn->connect_error) {
//         //     die("Connection failed: " . $conn->connect_error);
//         // }
//         // echo "Connected successfully";
//     }
// }

// new Connection;