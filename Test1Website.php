<?php
  $fname = $_POST["name"]?? '';
  $lname = $_POST["surname"]?? '';
  $id = $_POST["id"]?? '';
  $DoB = $_POST["DoB"]?? '';

  include_once "db.php";
//Selecting test2_db as current database
$dbSelected = $conn -> select_db($db1);

//Checking if the database was selected or exits
if(!$dbSelected){
  
  $sqlCreateDB = "create database $db1";

  //Creating the database if it doesnt exit or was not selected
  if($conn ->query($sqlCreateDB)){
    echo("Database created</</br>") ;
  }else{
    echo  $conn->error."</br>"." Selecting Database now";
  }
}

$sqlCreateTable = "create table customerInformation(
name varchar(30) not null,
surname varchar(50) not null,
id varchar(13) primary key,
dob varchar(10) not null
)";

//Validating whether query was successful
if($conn->query($sqlCreateTable) === True){
  echo "Table created </br>";

}else if($conn->error == "Table 'customerinformation' already exists"){
  
}

 ?>

<html>
<head>
  <style>
  label{
    font-size: large;
  }
  input[type=text], select {
  width: 50%;
  text-align:left;
  font-size: medium;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=button] {
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

   <!--Creating user form!-->
  <form action="Test1Website.php" method="post">
    <label>Name: </label><br>
      <input type ="text" placeholder="Enter Name" value = "<?php echo ($fname); ?>" name ="name" pattern="[a-zA-Z]{1,}" required autocomplete="off"><br>
    <label>Surname: </label><br>
      <input type ="text"placeholder="Enter Surname" value = "<?php echo ($lname); ?>" name = "surname" pattern="[a-zA-Z]{1,}"required autocomplete="off" ><br>
    <label>Id no: </label><br>
      <input type ="text"placeholder="Enter Id number"value = "<?php echo ($id); ?>"  name = "id" required autocomplete="off"><br>
    <label> Date of Birth: </label><br>
      <input type ="text" placeholder="Enter Date of Birth" value = "<?php echo ($DoB); ?>" name= "DoB" required autocomplete="off"><br>

    <input type ="submit" value="Post" name = "post">
    <a href="#Cancel">
    <input type ="button"  value= "Cancel" name = "cancel">
</a>
  </form>
 
<?php 

include "formValidation.php"; 


?>

</body>
</htm>
