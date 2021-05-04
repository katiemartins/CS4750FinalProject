<?php
session_start();
include_once('connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST"){


    $sql="INSERT INTO Committee (Name, Category, Type)
    VALUES
    ('$_POST[name]','$_POST[category]','$_POST[type]')";


    $query = $conn->prepare($sql);
    $query->execute();
    // $columns = $query->fetchAll();
    echo "1 record added";

    header("Location: Admin_page.html");
}
?>