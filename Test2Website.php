
<html>
<head>
<style>
  label{
    font-size: large;
  }
  input[type=text], select {
  width: 50%;
  text-align:left;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;

}
input[type=file] {
 
  font-size: medium; 
  color: black;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
  input[type=submit] {
  width: 50%;
  font-size: medium;
  background-color:chocolate;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}


  </style>
</head>
<body>

<label>CSV user generator</label>
<form action="Test2Website.php" method="post" enctype="multipart/form-data">
    <input type="text" placeholder="Enter number..." name="CSVGen" autocomplete="off"><br>
    <input type="file" name = "file"><br>
    <input type="submit" name="submit" value="Submit">
</form>
<?php
include_once "db.php";
//Selecting test2_db as current database
$dbSelected = $conn -> select_db($db2);

//Checking if the database was selected or exits
if(!$dbSelected){
  
  $sqlCreateDB = "create database $db2";

  //Creating the database if it doesnt exit or was not selected
  if($conn ->query($sqlCreateDB)){
    echo("Database created") ;
  }else{
    echo "Error creating database ". $conn->error."</br>";
  }
}

$sqlCreateTable = "create table csv_import(
id int(10) primary key,
name varchar(50) not null,
surname varchar(50) not null,
initials char(10) not null,
age int(30) not null,
dob varchar(30) not null

)";

//Validating whether query was successful
if($conn->query($sqlCreateTable) === True){
  echo "Table created </br>";

}else if($conn->error == "Table 'csv_import' already exists"){
  
}
include "formCSV.php";
 ?>
</body>

</html>