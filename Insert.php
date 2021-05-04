<?php

// insert connection check
session_start();
include_once('connection.php');

$sql="INSERT INTO tab (attributes)
VALUES
('$_POST[attributes]')";

if (!mysqli_query($conn,$sql))
  {
  die('Error: ' . mysqli_error($conn));
  }
echo "1 record added";

mysqli_close($conn);

?>