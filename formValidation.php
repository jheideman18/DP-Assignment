<?php
  include_once "db.php";

//Selecting test1_db as current database
  $dbSelected =  $conn->select_db($db1);
 
  $fname = $_POST["name"]?? '';
  $lname = $_POST["surname"]?? '';
  $id = $_POST["id"]?? '';
  $DoB = $_POST["DoB"]?? '';
  $submit = $_POST['post']?? '';
  
  //Creates an pop-up alert message 
  function functionAlert($message){
    echo "<script>alert('$message');</script>";
  }

  //Changes format for any given date to d-m-Y
  function dateValidate($DoB, $format = 'd/m/Y')
{
    $dateObj= DateTime::createFromFormat($format, $DoB);
    return $dateObj && $dateObj->format($format) == $DoB;
}

        //Inserting form information into customerInformation table
        $sqlInsert="insert into customerInformation(name,surname,id,dob) values('$fname','$lname','$id','$DoB')";
        
        //Gets the length of string id
        $idLength = strlen($id);

      
      //Validate whether id entered is 13 characters long
       
        if($idLength !=13){

          functionAlert("ID number must be 13 numbers");
  
          }
        else if($idLength == 13){
        
          //Validate whether date format is correct
          if(dateValidate($DoB) == false){
  
            functionAlert("Date format is incorrect.Day/Month/Year is the correct format");
  
          }
          //Validating whether query was successful
          else if($conn->query($sqlInsert) === TRUE){
            
            functionAlert("Information successfully added");
  
            //Redirects user to the same page
            //Helps to clear previous inputted variable
           
            
          }
           //Replacing the validation message for duplication error
          //Checks whether error is the duplication error message
          else if($conn->error == "Duplicate entry '$id' for key 'PRIMARY'"){ 
  
            functionAlert("This id already exits.");
  
          }else{
            echo $conn->error;
          }
         
        }
       
       
      //Closes database connection
      $conn -> close(); 
 ?>
