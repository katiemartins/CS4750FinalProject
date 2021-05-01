<?php

// insert connection check

$sql="INSERT INTO tab (attributes)
VALUES
('$_POST[attributes]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "1 record added";

mysqli_close($con);

?>