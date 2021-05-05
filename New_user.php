<?php

//https://www.geeksforgeeks.org/how-to-create-admin-login-page-using-php/
//https://www.php.net/manual/en/function.mysql-num-rows.php

session_start();
include_once('connection.php');

function test_input($data) {
        
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"]== "POST") {
        
    $adminname = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $hashed_password = hash("sha256", $password);
    $stmt = $conn->prepare("SELECT * FROM UserLogin");
    $stmt->execute();
    $users = $stmt->fetchAll();
    $bool = false;
    foreach($users as $user) {
            
        if(($user['Name'] == $adminname) ||
            ($user['Password'] == $hashed_password)) {
            echo "<script language='javascript'>";
            echo "alert('INFORMATION ALREADY USED')";
            echo "</script>";
            $bool = true;
        }
    }
    if ($bool == false) {
        $stmt = $conn->prepare("INSERT INTO UserLogin (Name, Password) VALUES ('$adminname', '$hashed_password')");
        $stmt->execute();
        header("Location: User_page.html");
    }
}
    
?>