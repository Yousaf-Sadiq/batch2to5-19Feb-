<?php


if (!isset($email) || empty($email)) {
 $status["error"]++;

 array_push($status["msg"], "EMAIL FIELD IS REQUIRED");
}



if (!isset($password) || empty($password)) {
 $status["error"]++;

 array_push($status["msg"], "PASSWORD FIELD IS REQUIRED");
}



?>