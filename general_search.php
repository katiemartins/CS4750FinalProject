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
        $query = $conn->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
    }
    else if ($comparison == "greater_than"){
        $sql = "SELECT * FROM $table WHERE $attribute > $value LIMIT $limit";
        $query = $conn->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
    }
    else if ($comparison == "less_than_or_equal"){
        $sql = "SELECT * FROM $table WHERE $attribute <= $value LIMIT $limit";
        $query = $conn->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
    }
    else if ($comparison == "greater_than_or_equal"){
        $sql = "SELECT * FROM $table WHERE $attribute >= $value LIMIT $limit";
        $query = $conn->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
    }
    else if ($comparison == "equal"){
        if(gettype($value) == "string"){
            $sql = "SELECT * FROM $table WHERE $attribute LIKE '%$value%' LIMIT $limit";
        }
        else{
            $sql = "SELECT * FROM $table WHERE $attribute = $value LIMIT $limit";
        }
        $query = $conn->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
    }
    else{
        echo "<script language='javascript'>";
        echo "alert('INVALID SEARCH REQUEST')";
        echo "</script>";
        die();
    }
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table' ORDER BY ORDINAL_POSITION";
    $query = $conn->prepare($sql);
    $query->execute();
    $columns = $query->fetchAll();
}
?>

<head>
    <link rel = "stylesheet" type "text/css" href = "stylesheet.css">
</head>
<body style = "height: 100%; margin: 0px;">
    <a class = "back" href = "Search.html">Back</a>
    <div id = "table">
        <table>
            <?php foreach($columns as $column): ?>
                <?php $bool = false; ?>
                <?php foreach($column as $col): ?>
                    <?php if ($bool == false): ?>
                        <th><?= $col;?></th>
                        <?php $bool = true; ?>
                    <?php endif; ?>
                    <!-- <th><?= $col;?></th> -->
                <?php endforeach; ?>
            <?php endforeach; ?>
            <?php foreach($data as $row): ?>
                <tr>
                <?php $num = 1; ?>
                    <?php foreach($row as $item): ?>

                        <?php if ($num == 1): ?>
                            <td><?= $item;?></td>
                        <?php endif; ?>

                        <?php $num = -1 * $num ?>
                        <!-- <td><?= $item;?></td> -->
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
