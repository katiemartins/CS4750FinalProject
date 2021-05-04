<?php
session_start();
include_once('connection.php');

function test_input($data) {    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $table = test_input($_GET["table"]);
    $attribute = test_input($_GET["attribute"]);
    $value = test_input($_GET["value"]);
    $comparison = test_input($_GET["comparison"]);
    $limit = test_input($_GET["limit"]);
    $sql = "";
    
    if ($comparison == "less_than"){
        $sql = "SELECT * FROM $table WHERE $attribute < $value LIMIT $limit";
        $query = mysqli_query($conn, $sql);
    }
    else if ($comparison == "greater_than"){
        $sql = "SELECT * FROM $table WHERE $attribute > $value LIMIT $limit";
        $query = mysqli_query($conn, $sql);
    }
    else if ($comparison == "less_than_or_equal"){
        $sql = "SELECT * FROM $table WHERE $attribute <= $value LIMIT $limit";
        $query = mysqli_query($conn, $sql);
    }
    else if ($comparison == "greater_than_or_equal"){
        $sql = "SELECT * FROM $table WHERE $attribute >= $value LIMIT $limit";
        $query = mysqli_query($conn, $sql);
    }
    else if ($comparison == "equal"){
        $sql = "SELECT * FROM $table WHERE $attribute = $value LIMIT $limit";
        $query = mysqli_query($conn, $sql);
    }
    else{
        die();
    }

    while($row = mysqli_fetch_array($result)){
        foreach($row as $val){
            echo $val;
            echo " ";
        }
        echo "<br>";
    }
}
?>