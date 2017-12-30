<?php

require_once("etc/config.php");
require_once("lib/pdo.php");

// visszaadja a sorok szamat
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

// sql lekerdezes mintaja
//SELECT * FROM `szavak` WHERE length(t_szo)<10 
//and (t_szo not LIKE '%a%') 
//and (t_szo not LIKE '%j%')
//and (t_szo not LIKE '%h%')
//and (t_szo not LIKE '%t%')
//and (t_szo not LIKE '%y%')
//and (t_szo not LIKE '%z%')

// rovid szo 3
// hosszu szo 25???

$sql = "SELECT * FROM `szavak` WHERE ";

if(isset($_GET["szotag_min"]))
  $szotag_min = intval($_GET["szotag_min"]);
else
  $szotag_min = 3;

if ($szotag_min < 3)
  $szotag_min = 3;

if ($szotag_min > 25)
  $szotag_min = 25;

if(isset($_GET["szotag_max"]))
  $szotag_max = intval($_GET["szotag_max"]);
else
  $szotag_max = 12;

if ($szotag_max > 25)
  $szotag_max = 25;

if ($szotag_max < 3)
  $szotag_max = 3;

if($szotag_max < $szotag_min)
{
  $a = $szotag_max;
  $szotag_max = $szotag_min;
  $szotag_min = $a;
}
  
$sql .= " length(t_szo)>= ".$szotag_min." and length(t_szo)<=".$szotag_max." ";

if(!isset($_GET["a"])) $sql .= "and (t_szo not LIKE '%a%') ";
if(!isset($_GET["aa"])) $sql .= "and (t_szo not LIKE '%á%') ";
if(!isset($_GET["b"])) $sql .= "and (t_szo not LIKE '%b%') ";
if(!isset($_GET["c"])) $sql .= "and (t_szo not LIKE '%c%') ";
if(!isset($_GET["cs"])) $sql .= "and (t_szo not LIKE '%cs%') ";
if(!isset($_GET["d"])) $sql .= "and (t_szo not LIKE '%d%') ";
if(!isset($_GET["dz"])) $sql .= "and (t_szo not LIKE '%dz%') ";
if(!isset($_GET["dzs"])) $sql .= "and (t_szo not LIKE '%dzs%') ";
if(!isset($_GET["e"])) $sql .= "and (t_szo not LIKE '%e%') ";
if(!isset($_GET["ee"])) $sql .= "and (t_szo not LIKE '%é%') ";
if(!isset($_GET["f"])) $sql .= "and (t_szo not LIKE '%f%') ";
if(!isset($_GET["g"])) $sql .= "and (t_szo not LIKE '%g%') ";
if(!isset($_GET["gy"])) $sql .= "and (t_szo not LIKE '%gy%') ";
if(!isset($_GET["h"])) $sql .= "and (t_szo not LIKE '%h%') ";
if(!isset($_GET["i"])) $sql .= "and (t_szo not LIKE '%i%') ";
if(!isset($_GET["ii"])) $sql .= "and (t_szo not LIKE '%í%') ";
if(!isset($_GET["j"])) $sql .= "and (t_szo not LIKE '%j%') ";
if(!isset($_GET["k"])) $sql .= "and (t_szo not LIKE '%k%') ";
if(!isset($_GET["l"])) $sql .= "and (t_szo not LIKE '%l%') ";
if(!isset($_GET["ly"])) $sql .= "and (t_szo not LIKE '%ly%') ";
if(!isset($_GET["m"])) $sql .= "and (t_szo not LIKE '%m%') ";
if(!isset($_GET["n"])) $sql .= "and (t_szo not LIKE '%n%') ";
if(!isset($_GET["ny"])) $sql .= "and (t_szo not LIKE '%ny%') ";
if(!isset($_GET["o"])) $sql .= "and (t_szo not LIKE '%o%') ";
if(!isset($_GET["oo"])) $sql .= "and (t_szo not LIKE '%ó%') ";
if(!isset($_GET["ooo"])) $sql .= "and (t_szo not LIKE '%ö%') ";
if(!isset($_GET["oooo"])) $sql .= "and (t_szo not LIKE '%ő%') ";
if(!isset($_GET["p"])) $sql .= "and (t_szo not LIKE '%p%') ";
if(!isset($_GET["q"])) $sql .= "and (t_szo not LIKE '%q%') ";
if(!isset($_GET["r"])) $sql .= "and (t_szo not LIKE '%r%') ";
if(!isset($_GET["s"])) $sql .= "and (t_szo not LIKE '%s%') ";
if(!isset($_GET["sz"])) $sql .= "and (t_szo not LIKE '%sz%') ";
if(!isset($_GET["t"])) $sql .= "and (t_szo not LIKE '%t%') ";
if(!isset($_GET["ty"])) $sql .= "and (t_szo not LIKE '%ty%') ";
if(!isset($_GET["u"])) $sql .= "and (t_szo not LIKE '%u%') ";
if(!isset($_GET["uu"])) $sql .= "and (t_szo not LIKE '%ú%') ";
if(!isset($_GET["uuu"])) $sql .= "and (t_szo not LIKE '%ü%') ";
if(!isset($_GET["uuuu"])) $sql .= "and (t_szo not LIKE '%ű%') ";
if(!isset($_GET["v"])) $sql .= "and (t_szo not LIKE '%v%') ";
if(!isset($_GET["w"])) $sql .= "and (t_szo not LIKE '%w%') ";
if(!isset($_GET["x"])) $sql .= "and (t_szo not LIKE '%x%') ";
if(!isset($_GET["y"])) $sql .= "and (t_szo not LIKE '%y%') ";
if(!isset($_GET["z"])) $sql .= "and (t_szo not LIKE '%z%') ";
if(!isset($_GET["zs"])) $sql .= "and (t_szo not LIKE '%zs%') ";

$filename = dirname(__FILE__)."/doc/sql-query.sql";
$f = fopen($filename,"w");
$b = fwrite($f, $sql);
$c = fclose($f);
//echo $sql;

$stmt = GetMySqlLink()->prepare($sql);
$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);
//while($row = $stmt->fetch()) 
//{
//    echo $row['t_szo'] . "<br />\n";
//}
//$stmt->setFetchMode(PDO::FETCH_All);
$result = $stmt->fetchAll();
header('Content-Type: application/json; charset=utf-8');
echo json_encode( $result);
