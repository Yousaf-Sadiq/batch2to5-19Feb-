<?php
define("HOST", "localhost");
define("USERNAME", "root");
define('PASSWORD', '');
define('DB', 'crud_project2');


$conn = new mysqli(HOST, USERNAME, PASSWORD, DB); // php oops
// $conn= mysqli_connect(HOST,USERNAME,PASSWORD,DB); //core  php 


if ($conn) {
 // echo "Established";
} else {
 echo $conn->error;
}


?>