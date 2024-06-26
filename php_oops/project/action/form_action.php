<?php
require_once dirname(__DIR__) . "/src/database.php";

use src\database\database as DB;
use src\database\helper as help;

$helper = new help;

$db = new DB;

if (isset($_POST["delete"]) && !empty($_POST["delete"])) {
  $user_id = $helper->filter_data($_POST["user_id"]);

  echo $db->delete("users", "id = {$user_id}");

}


if (isset($_POST["update"]) && !empty($_POST["update"])) {

  $email = $helper->filter_data($_POST["email"]);
  $user_id = $helper->filter_data($_POST["user_id"]);
  $user_name = $helper->filter_data($_POST["user_name"]);

  $data = [
    "email" => $email,
    "user_name" => $user_name,
  ];

  $status = [
    "error" => 0,
    "msg" => []
  ];



  if (!isset($email) || empty($email)) {
    $status["error"]++;

    array_push($status["msg"], "EMAIL FIELD IS REQUIRED");
  }



  if (!isset($user_name) || empty($user_name)) {
    $status["error"]++;

    array_push($status["msg"], "USERNAME FIELD IS REQUIRED");
  }


  if ($status["error"] > 0) {

    echo json_encode($status);
  } else {


    echo $db->update("users", $data, " `id` = '{$user_id}'");

  }




}


// $row[2]["username"];

// $helper->pre($row);

if (isset($_POST["insert"]) && !empty($_POST["insert"])) {

  $email = $helper->filter_data($_POST["email"]);
  $pswd = $helper->filter_data($_POST["pswd"]);

  $status = [
    "error" => 0,
    "msg" => []
  ];



  if (!isset($email) || empty($email)) {
    $status["error"]++;

    array_push($status["msg"], "EMAIL FIELD IS REQUIRED");
  }



  if (!isset($pswd) || empty($pswd)) {
    $status["error"]++;

    array_push($status["msg"], "PASSWORD FIELD IS REQUIRED");
  }


  if ($status["error"] > 0) {

    echo json_encode($status);
  } else {

    $hash = password_hash($pswd, PASSWORD_BCRYPT);

    $encrypt = base64_encode($pswd);


    $data = [
      "email" => $email,
      "password" => $hash,
      "ptoken" => $encrypt
    ];


    // =-=====================check email if already exist or not
    if ($db->checkEmail($email, "users")) {

      $status["error"]++;
      array_push($status["msg"], "Email already exist");

      echo json_encode($status);

    } else {
      $insert = $db->insert_table("users", $data);

      echo $insert;
    }


  }





}
?>