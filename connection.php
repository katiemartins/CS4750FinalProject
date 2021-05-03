<?php
 
$conn = "";
  
try {
    $servername = "usersrv01.cs.virginia.edu";
    $dbname = "wgt7xp_";
    $username = "wgt7xp";
    $password = "Spr1ng2021!!";
  
    $conn = new PDO(
        "mysql:host=$servername; dbname=$dbname",
        $username, $password
    );
     
   $conn->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
 
?>