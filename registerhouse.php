<?php
   
    $name = isset($_GET['name'])? $_GET['name']: '' ;
    echo $name;
    $email = isset($_GET['email'])? $_GET['email']: '' ;
    echo $email;
    $password = isset($_GET['password'])? $_GET['password']: '' ;
    echo $password;
    $contact = isset($_GET['contact'])? $_GET['contact']: '' ;
    echo $contact;
    $citizenship = isset($_GET['citizenship'])? $_GET['citizenship']: '' ;
    echo $citizenship;
    $province = isset($_GET['province'])? $_GET['province']: '' ;
    echo $province;
    $zone = isset($_GET['zone'])? $_GET['zone']: '' ;
    echo $zone;
    $district= isset($_GET['district'])? $_GET['district']: '' ;
    echo $district;
   
   




if (!empty($name) || !empty($email) ||!empty($password) || !empty($contact)|| !empty($citizenship) || !empty($province) || !empty($zone) || !empty($district)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "bernhack";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        } else {
     $SELECT = "SELECT email From house Where email = ? Limit 1";
     $INSERT = "INSERT Into house(name, email, password, contact,citizenship, province, zone, district) values(?, ?, ?,?, ?, ?,?,?)";
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
      $stmt->bind_param("sssibiss", $name, $email, $password, $contact,$citizenship, $province, $zone, $district);
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