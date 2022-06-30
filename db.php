<?php
/*
Things to note:
The database used for testing is mySql.
In Test2.php, The database did not accept uploads because of 'secure_file_priv'. Once turned off
it allowed me to upload the csv file.
*/

//Setting up all necessary information for mySql 
  $host = "localhost";
  $user = "root";
  $pass = "";
  $db1 = "test1_db";
  $db2 = "test2_db";

  //Connect to MySQL
  $conn = mysqli_connect($host,$user,$pass);
  
  //Check if connection was succesful
  if($conn === false){
    die ("database is not connected");
  }
  ?>