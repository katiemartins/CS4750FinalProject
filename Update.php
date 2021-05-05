<?php
session_start();
include_once('connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST"){

    //Get all committee names
    $stmt = $conn->prepare("SELECT Name FROM Committee");
    $stmt->execute();
    $namelist = $stmt->fetchAll();

    $bool = false;

    foreach($namelist as $thisname) {
        //Check if the committee name is valid to update
        if ($thisname['Name'] == $_POST["name"]){   ///SUS
            $bool = true;
            $sql= "UPDATE Committee
            SET Category = '$_POST[category]', Type = '$_POST[type]'
            WHERE Name = '$_POST[name]'";
            $query = $conn->prepare($sql);
            $query->execute();

            //Doesn't work for some reason
            // echo "<script language='javascript'>";
            // echo "alert('1 record updated')";
            // echo "</script>";

            header("Location: Admin_page.html");            
        }
    }
    //Execute only if the Name was not found in the table to update
    if ($bool == false){
        echo "<script language='javascript'>";
        echo "alert('INVALID UPDATE REQUEST')";
        echo "</script>";
        die();
    }
}
?>