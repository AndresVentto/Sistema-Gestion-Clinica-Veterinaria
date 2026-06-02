<?php

$sql = "SELECT * FROM tbl_productos ";
$query = $pdo->prepare($sql);
$query->execute();
$productos = $query->fetchAll(PDO::FETCH_ASSOC);


?>