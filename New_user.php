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
     
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
     
    $sql = "INSERT INTO UserLogin (Name, Password) VALUES ($username, $password)";

    $user_u = $conn->prepare("SELECT * FROM UserLogin WHERE Name='$username'");
    $pass_u = $conn->prepare("SELECT * FROM UserLogin WHERE Password='$password'");
    $user_u->execute();
    $pass_u->execute();
    $users = $user_u->fetchAll();
    $passes = $pass_u->fetchAll();
    
    foreach($users as $use){
        if($use['username'] == $username) {
            echo "<script language='javascript'>";
            echo "alert('USERNAME TAKEN')";
            echo "</script>";
             die();    
        }
    }

    foreach($passes as $pass){
        if($pass['password'] == $password) {
            echo "<script language='javascript'>";
            echo "alert('PASSWORD TAKEN')";
            echo "</script>";
            die();  
    }
}
    $query = mysqli_query($conn, $sql);
    header("Location: User_page.html");

}
?>