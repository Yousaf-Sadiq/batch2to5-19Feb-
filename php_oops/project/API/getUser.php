<?php 
header('Content-Type: application/json');

require_once dirname(__DIR__) . "/src/database.php";

use src\database\database as DB;
use src\database\helper as help;

$helper= new help;

$db= new DB;


$db->mySelect("users");

$row = ["data"=>$db->getResult()];

echo json_encode($row);

?>