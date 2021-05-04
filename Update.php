<?php
session_start();
include_once('connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $sql= "UPDATE Committee
    SET Category = '$_POST[category]', Type = '$_POST[type]'
    WHERE Name = '$_POST[name]'";

    $query = $conn->prepare($sql);
    $query->execute();
    //echo "1 record added";

    header("Location: Admin_page.html");
}
?>