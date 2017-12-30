<?php

require_once("etc/config.php");
require_once("lib/pdo.php");

//$sql = "SELECT COUNT(*) as szam FROM szavak";
//$stmt = GetMySqlLink()->prepare($sql);
//$stmt->execute();
//$stmt->setFetchMode(PDO::FETCH_ASSOC);
//while($row = $stmt->fetchAll())
//{
//  print_r($row);
//  echo $row[0]['szam'];
//} 
//echo "<br />\n";

$sql = "SELECT * FROM szavak";
$stmt = GetMySqlLink()->prepare($sql);
$stmt->execute();

$result = $stmt->fetchAll(); 
header('Content-Type: application/json');
echo json_encode($result);
