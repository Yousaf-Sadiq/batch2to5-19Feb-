<?php

require_once dirname(__DIR__) . "/../layout/user/header.php";



?>

<?php


if (isset($_POST["insert"]) && !empty($_POST["insert"])) {

 $email = filter_data($_POST["email"]);
 $password = filter_data($_POST["pswd"]);

 // validation 

 $status = [
  "error" => 0,
  "msg" => array()
 ];

 require_once "./error/home.php";


 if ($status["error"] > 0) {

  foreach ($status["msg"] as $msg) {
   ERROR_MSG($msg);
  }

  refresh_url(3, HOME);

 } else {



  $hash = password_hash($password, PASSWORD_BCRYPT);

  $encrypt = base64_encode($password);



  $insert = "INSERT INTO `users` (`email`,`password`,`ptoken`)
 VALUES ('{$email}','{$hash}','{$encrypt}' )";

  $exe = $conn->query($insert);


  if ($exe) {
   if ($conn->affected_rows > 0) {
    Success_MSG("DATA HAS BEEN INSERTED");
   } else {
    ERROR_MSG("DATA HAS NOT BEEN INSERTED" . $insert);
   }
  }


  refresh_url(3, HOME);



 }


}


?>


<?php

require_once dirname(__DIR__) . "/../layout/user/footer.php";


// http://localhost/19Feb_php/project_crud/action/user/form_action.php
?>