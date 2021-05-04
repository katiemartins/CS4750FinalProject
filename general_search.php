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
        $sql = "SELECT * FROM $table WHERE $attribute = $value LIMIT $limit";
        $query = $conn->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
    }
    else{
        die();
    }
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table' ORDER BY ORDINAL_POSITION";
    $query = $conn->prepare($sql);
    $query->execute();
    $columns = $query->fetchAll();
}
?>

<table>
    <?php foreach($columns as $column): ?>
        <?php foreach($column as $col): ?>
            <th><?= $col;?></th>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <?php foreach($data as $row): ?>
        <tr>
            <?php foreach($row as $item): ?>
                <td><?= $item;?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
