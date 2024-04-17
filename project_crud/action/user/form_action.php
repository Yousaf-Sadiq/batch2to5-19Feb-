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

  // =-=====================check email if already exist or not
  $check_email = "SELECT * FROM `users` WHERE `email`= '{$email}'";

  $exe_email = $conn->query($check_email);


  if ($exe_email->num_rows > 0) {

    $status["error"]++;
    array_push($status["msg"], "Email already exist");


  }
  // ====================================================


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

        $_SESSION["user_id"]= $conn->insert_id;
        $_SESSION["email"]= $email;


        Success_MSG("DATA HAS BEEN INSERTED");
      } else {
        ERROR_MSG("DATA HAS NOT BEEN INSERTED" . $insert);
      }
    }


    refresh_url(3, HOME);



  }


}






// update work 



if (isset($_POST["update"]) && !empty($_POST["update"])) {

  $email = filter_data($_POST["email"]);
  $password = filter_data($_POST["pswd"]);
  $user_name = filter_data($_POST["user_name"]);
  $user_id = filter_data(base64_decode($_POST["token"]));

  // validation 

  $status = [
    "error" => 0,
    "msg" => array()
  ];

  require_once "./error/home.php";

  // =-=====================check email if already exist or not ===================
  $check_email = "SELECT * FROM `users` WHERE `email`= '{$email}' AND `user_id` != '{$user_id}'";

  $exe_email = $conn->query($check_email);


  if ($exe_email->num_rows > 0) {

    $status["error"]++;
    array_push($status["msg"], "Email already exist");


  }
  // ====================================================


  if ($status["error"] > 0) {

    foreach ($status["msg"] as $msg) {
      ERROR_MSG($msg);
    }

    refresh_url(3, HOME);

  } else {






    $hash = password_hash($password, PASSWORD_BCRYPT);

    $encrypt = base64_encode($password);

    $fileUpload = $_FILES["profile"]["name"];
    // =====================================================

    $check_address = "SELECT * FROM  `user_address` WHERE `user_id` = '{$user_id}' ";

    $checkExe = $conn->query($check_address);



    // case 1 

    /*
    if user only updated picture while data remain same 

    */



    if (isset($fileUpload) && !empty($fileUpload)) {


      $ext = ["jpg", "jpeg", "png"];

      $destination = "/asset/upload/";

      $file = FileUPload("profile", $ext, $destination);

      $RelativeUrl = $file[0];

      $absoluteUrl = $file[1];






      $update = "UPDATE `users` SET `email`='{$email}' ,`password`='{$hash}'
 ,`ptoken`='{$encrypt}' , `user_name`='{$user_name}' WHERE `user_id` = '{$user_id}' ";


      if ($checkExe->num_rows > 0) {

        $oldFile = $checkExe->fetch_assoc();

        // echo $oldFile["relativeUrl"];

        if (file_exists($oldFile["relativeUrl"])) {
          unlink($oldFile["relativeUrl"]);

          echo "ok";
        }

        // if (file_exists($oldFile["image"])) {
        //  unlink($oldFile["image"]);
        // }

        $sql_address1 = "UPDATE `user_address` SET `relativeUrl`='{$RelativeUrl}', `image`='{$file[1]}' WHERE `user_id`='{$user_id}'";

        $exe2 = $conn->query($sql_address1);



      } else {
        $sql_address2 = "INSERT INTO  `user_address` (`relativeUrl`,`image`,`user_id`) VALUES ('{$RelativeUrl}','{$absoluteUrl}','{$user_id}')";

        $exe2 = $conn->query($sql_address2);

        $lastInsertId = $conn->insert_id;


        $update = "UPDATE `users` SET `email`='{$email}' ,`password`='{$hash}'
    ,`ptoken`='{$encrypt}' , `user_name`='{$user_name}' , `address_id`='{$lastInsertId}' WHERE `user_id` = '{$user_id}' ";


      }






    }
    // ===================================================
    // case 2  

    /*
    if user only updated data while picture remain same 

    */ else {

      $file = true;



      $update = "UPDATE `users` SET `email`='{$email}' ,`password`='{$hash}'
 ,`ptoken`='{$encrypt}' , `user_name`='{$user_name}' WHERE `user_id` = '{$user_id}' ";


      if ($checkExe->num_rows > 0) {

        $sql_address1 = "UPDATE `user_address` SET `address`='none' WHERE `user_id`='{$user_id}'";
        $exe2 = $conn->query($sql_address1);

      } else {
        $sql_address2 = "INSERT INTO  `user_address`  (`address`,`user_id`) VALUES ('none','{$user_id}')";

        $exe2 = $conn->query($sql_address2);

        $lastInsertId = $conn->insert_id;


        $update = "UPDATE `users` SET `email`='{$email}' ,`password`='{$hash}'
    ,`ptoken`='{$encrypt}' , `user_name`='{$user_name}' , `address_id`='{$lastInsertId}' WHERE `user_id` = '{$user_id}' ";


      }



    }






    // case 3 

    /*
    if user updated picture and data also 

    */





    if ($file == false) {
      refresh_url(2, HOME);
    } else {

      $exe = $conn->query($update);



      if ($exe) {
        if ($conn->affected_rows > 0) {
          Success_MSG("DATA HAS BEEN UPDATED");
        } else {
          ERROR_MSG("DATA HAS NOT BEEN UPDATED" . $update);
        }
      }


      refresh_url(3, HOME);


    }





  }


}


if (isset($_POST["file_upload"]) && !empty($_POST["file_upload"])) {

  // $file= $_FILES["profile"];


  // $file_name=$file["name"];

  // $tmpName=$file["tmp_name"];
  $ext = ["jpg", "jpeg", "png"];

  $destination = "/asset/upload/";

  $file = FileUPload("profile", $ext, $destination);

  if ($file == false) {
    refresh_url(2, HOME);
  }


  // move_uploaded_file($tmpName,$destination);

}

// ==================================================

// delete form


if (isset($_POST["delete"]) && !empty($_POST["delete"])) {

  $user_id = filter_data($_POST["user_id"]);


  $fetch_sql2 = "SELECT * FROM `user_address` WHERE `user_id`='{$user_id}'";

  $qwer2 = $conn->query($fetch_sql2);

  if ($qwer2->num_rows > 0) {

    $row2 = $qwer2->fetch_assoc();


    if (file_exists($row2["relativeUrl"])) {
      unlink($row2["relativeUrl"]);
    }

    $del_fetch_sql2 = "DELETE FROM `user_address` WHERE `user_id`='{$user_id}'";

    $del_qwer2 = $conn->query($del_fetch_sql2);


  }


  $del_fetch_sql2 = "DELETE FROM `users` WHERE `user_id`='{$user_id}'";

  $del_qwer2 = $conn->query($del_fetch_sql2);


  if ($del_qwer2) {

    if ($conn->affected_rows > 0) {
      Success_MSG("DATA HAS BEEN DELETED");
    } else {
      ERROR_MSG("DATA HAS NOT BEEN DELETED" . $del_fetch_sql2);
    }

    refresh_url(2, HOME);
  }



}

?>


<?php

require_once dirname(__DIR__) . "/../layout/user/footer.php";


// http://localhost/19Feb_php/project_crud/action/user/form_action.php
?>