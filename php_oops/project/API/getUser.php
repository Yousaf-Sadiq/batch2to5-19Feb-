<?php 
header('Content-Type: application/json');

require_once dirname(__DIR__) . "/src/database.php";

use src\database\database as DB;
use src\database\helper as help;

$helper= new help;

$db= new DB;
// ternary operator  condition ? true : false 

$limit = isset($_POST['length']) ? intval($_POST['length']) : 10; // Number of records per page

$offset = isset($_POST['start']) ? intval($_POST['start']) : 0;


$sql_total = "SELECT count(*) as total FROM `users`";

$db->Mysql($sql_total,true);

$totalRecords = $db->getCount();

// total = 16 




$db->mySelect("users",null,null," LIMIT {$limit} OFFSET {$offset}");

// $row = ["data"=>$db->getResult()];

$output = array(
 "draw" => isset($_POST['draw']) ? intval($_POST['draw']) : 1, // current page 
 "recordsTotal" => $totalRecords[0]["total"], // Total number of records
 "recordsFiltered" => $totalRecords[0]["total"], // Total number of records after filtering (if applied)
 "data" => $db->getResult() // Array of records
);

echo json_encode($output);

?>