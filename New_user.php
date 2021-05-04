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
    $stmt = $conn->prepare("SELECT * FROM UserLogin");
    $stmt->execute();
    $users = $stmt->fetchAll();
     
    $sql = "INSERT INTO UserLogin (Name, Password) VALUES ($username, $password)";

    $user_u = "SELECT * FROM Users WHERE Name='$username'";
    $pass_u "SELECT * FROM Users WHERE Password='$password'";
    
    if (mysqli_num_rows($user_u) > 0) {
        echo "<script language='javascript'>";
        echo "alert('USERNAME TAKEN')";
        echo "</script>";
        die();
    }
    else if (mysqli_num_rows($pass_u) > 0) {
        echo "<script language='javascript'>";
        echo "alert('PASSWORD TAKEN')";
        echo "</script>";
        die();
    }
    else{
        $query = mysqli_query($conn, $sql);
        header("Location: Admin_page.html");
    }
}
?>