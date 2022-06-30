<?php
$userInput = $_POST['CSVGen']?? '';
$submit = $_POST['submit']?? '';

 //Creates an pop-up alert message 
 function functionAlert($message){
  echo "<script>alert('$message');</script>";
}

    $name = array(
        "Sanjay",
        "Millie-Rose",
        "Alexandre",
        "Ritik" ,
        "Elouise" ,
        "Ravinder" ,
        "Liyah" ,
        "Ethel" ,
        "Dexter" ,
        "Tonicha" ,
        "Samiya" ,
         "Rian",
         "Charis" ,
         "Ellice" ,
         "Clare" ,
         "Miranda" ,
         "Carl" ,
         "Delia" ,
         "Elmer" ,
         "Jazmine");

    $surname = array(
        "Bauer",
        "Ford",
        "Bass" ,
        "Hilton" ,
        "Rawlings" ,
        "Byrne" ,
        "Simpson" ,
        "Novak" ,
        "Iles",
        "Nielsen" ,
        "Cantrell" ,
        "Ayers" ,
        "James" ,
        "Stevenson" ,
        "Mcconnell" ,
        "Sheppard" ,
        "Parkinson" ,
        "Harvey",
        "Hess",
        "Sears");


    function createCSV($size){
    //Creating headers for the csv file
    $headers = "id Name Surname Intials Age Date of Birth";
    
    //Check to see if folder exits
    if(!file_exists(__DIR__."/output/")){
    //Creating a folder if no folder is found
        mkdir(__DIR__.'/output/',0777,true);
    }

    // Open a file in write mode ('w')
    $fp = fopen(__DIR__.'/output/output.csv', 'w+');

    fputcsv($fp,explode(',', $headers));

        //Loop through file pointer and a line
    for($i = 0; $i <$size; $i++){

        //Getting random date timestamps between 1952 - 2004
        $int = mt_rand(-547875724,1093119476);

        //Converting the timestamp to a date with d/m/Y format
        $dateString = date("d/m/Y",$int);
        $randomDate = date("Y",$int);
        $currDate = date("Y");

        //Gets the age of the random date that was generated
        $age = $currDate - $randomDate ;

        //Formatting lines as csv and writes it to the stream
        fputcsv($fp, array_unique(array(($i+1)." ",
        $r = $GLOBALS['name'][rand(0,count($GLOBALS['name'])-1)]." ",
        $GLOBALS['surname'][rand(0,count($GLOBALS['surname'])-1)]." ",
        substr($r,0,1)." ",
        $age." ",
        $dateString." "
        )));
       
    }
    
    //Closes file
    fclose($fp);
}

$file = $_FILES['file']['name']?? '';

  if(!empty($file) ){
    //Opens the file in read mode
    $csvFile = fopen($_FILES['file']['tmp_name'],'r');
    //Loops through data from csv file line by line
    while(($getData = fgetcsv($csvFile,$userInput,","))!== FALSE){
  
      //Getting row data
      $id = $getData[0]?? '';
      $name = $getData[1]?? '';
      $surname = $getData[2]?? '';
      $initials = $getData[3]?? '';
      $age = $getData[4]?? '';
      $dob = $getData[5]?? '';
  
      $sqlInsert = "insert into csv_import (id, name, surname, initials, age, dob) 
      values ('$id','$name','$surname','$initials','$age','$dob')";
      $result = $conn->query($sqlInsert);
     
    }
    //Validate whether query was successful
    if($GLOBALS['result'] === TRUE){
      functionAlert("Data inserted");
    }
    //Close file
    fclose($csvFile);
  }


createCSV($userInput);
//Close database connection
$conn -> close();
?>