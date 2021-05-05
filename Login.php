<?php

//https://www.geeksforgeeks.org/how-to-create-admin-login-page-using-php/

session_start();
include_once('connection.php');

function test_input($data) {
     
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"]== "POST") {
     
    $adminname = test_input($_POST["adminname"]);
    $password = test_input($_POST["password"]);
    $hashed_password = hash("sha256", $password);
    $stmt = $conn->prepare("SELECT * FROM AdminLogin");
    $stmt->execute();
    $users = $stmt->fetchAll();

    $bool = false;
     
    foreach($users as $user) {
         
        if(($user['adminname'] == $adminname) &&
            ($user['password'] == $hashed_password)) {
                $bool = true;
                header("Location: Admin_page.html");
        }
    }

    if ($bool == false) {
        echo "<script language='javascript'>";
        echo "alert('INVALID LOGIN INFORMATION')";
        echo "</script>";
        die();
    }
}

?>