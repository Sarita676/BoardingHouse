<?php
   
    $name = isset($_GET['name'])? $_GET['name']: '' ;
    echo $name;
    $email = isset($_GET['email'])? $_GET['email']: '' ;
    echo $email;
    $password = isset($_GET['password'])? $_GET['password']: '' ;
    echo $password;
    $contact = isset($_GET['contact'])? $_GET['contact']: '' ;
    echo $contact;
    $passphoto= isset($_GET['passphoto'])? $_GET['passphoto']: '' ;
    echo $passphoto;
     $passno= isset($_GET['passno'])? $_GET['passno']: '' ;
    echo $passno;
   




if (!empty($name) || !empty($email) ||!empty($password) || !empty($contact)|| !empty($passphoto) || !empty($passno)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "bernhack";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register(name, email, password, contact,passphoto,passno) values(?, ?, ?,?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssibi", $name, $email, $password, $contact,$passphoto, $passno);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>