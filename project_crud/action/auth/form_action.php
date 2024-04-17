<?php

require_once dirname(__DIR__) . "/../layout/user/header.php";



?>

<?php


if (isset($_POST["login"]) && !empty($_POST["login"])) {

 $email = filter_data($_POST["email"]);
 $password = filter_data($_POST["pswd"]);

 // validation 

 $status = [
  "error" => 0,
  "msg" => array()
 ];

 require_once "./errors/login.php";

 // =-=====================check email if already exist or not
 // $check_email = "SELECT * FROM `users` WHERE `email`= '{$email}'";

 // $exe_email = $conn->query($check_email);


 // if ($exe_email->num_rows > 0) {

 //   $status["error"]++;
 //   array_push($status["msg"], "Email already exist");


 // }
 // ====================================================


 if ($status["error"] > 0) {

  foreach ($status["msg"] as $msg) {
   ERROR_MSG($msg);
  }

  refresh_url(3, HOME);

 } else {






  $hash = password_hash($password, PASSWORD_BCRYPT);

  $encrypt = base64_encode($password);



  $login = "SELECT * FROM `users` WHERE `email`= '{$email}' AND `ptoken`='{$encrypt}'";

  $exe = $conn->query($login);

  if ($exe->num_rows > 0) {

   $fetch_user = $exe->fetch_assoc();


   Success_MSG("LOGIN SUCCESSFULLY");

   $_SESSION["user_id"] = $fetch_user["user_id"];
   $_SESSION["email"] = $fetch_user["email"];

   refresh_url(2, DASHBOARD);

  } else {
   ERROR_MSG("YOU'R NOT  REGISTERED IN OUR PORTAL");
  }







 }


}



?>


<?php

require_once dirname(__DIR__) . "/../layout/user/footer.php";



?>