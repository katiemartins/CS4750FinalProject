<?php
session_start();
include_once('connection.php');

function test_input($data) {    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE"){
    $table = test_input($_POST["table"]);
    $attribute = test_input($_POST["attribute"]);
    $value = test_input($_POST["value"]);
    $comparison = test_input($_POST["comparison"]);
    $sql = "";
    
    if ($comparison == "less_than"){
        $sql = "DELETE FROM $table WHERE $attribute < $value LIMIT $limit";
        $query = $conn->prepare($sql);
        $query->execute();
        header("Location: Admin_page.html");
    }
    else if ($comparison == "greater_than"){
        $sql = "DELETE FROM $table WHERE $attribute > $value LIMIT $limit";
        $query = $conn->prepare($sql);
        $query->execute();
        header("Location: Admin_page.html");
    }
    else if ($comparison == "less_than_or_equal"){
        $sql = "DELETE FROM $table WHERE $attribute <= $value LIMIT $limit";
        $query = $conn->prepare($sql);
        $query->execute();
        header("Location: Admin_page.html");
    }
    else if ($comparison == "greater_than_or_equal"){
        $sql = "DELETE FROM $table WHERE $attribute >= $value LIMIT $limit";
        $query = $conn->prepare($sql);
        $query->execute();
        header("Location: Admin_page.html");
    }
    else if ($comparison == "equal"){
        if(gettype($value) == "string"){
            $sql = "DELETE FROM $table WHERE $attribute LIKE '%$value%' LIMIT $limit";
        }
        else{
            $sql = "DELETE FROM $table WHERE $attribute = $value LIMIT $limit";
        }$query = $conn->prepare($sql);
        $query->execute();
        header("Location: Admin_page.html");
    }
    else{
        die();
    }
}
?>