<?php

require_once dirname(__FILE__) . "/layout/user/header.php";


?>

<h1>UPDATE</h1>

<?php

if (!isset($_GET["q"]) || empty(filter_data($_GET["q"]))) {
  redirect_url(HOME);
}



$user_id = filter_data($_GET["q"]);

$fetch_sql = "SELECT * FROM `users` WHERE `user_id`='{$user_id}'";

$qwer = $conn->query($fetch_sql);


if ($qwer->num_rows > 0) {

  $row = $qwer->fetch_assoc();
// =============================================================================
  $fetch_sql2 = "SELECT * FROM `user_address` WHERE `user_id`='{$user_id}'";

  $qwer2 = $conn->query($fetch_sql2);


  if ($qwer2->num_rows > 0) {
    $row2 = $qwer2->fetch_assoc();
  }
  else{
    $row2=[
      "image"=>"default.jpg"
    ];
  }
  // ======================================================================
  ?>




  <form enctype="multipart/form-data" action="<?php echo update_form ?>" class="text-bg-dark p-5 m-5" method="POST">

    <input type="hidden" name="token" value="<?php echo base64_encode($user_id) ?>">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">NAME</label>
      <input type="text" value="<?php echo $row["user_name"]; ?>" name="user_name" class="form-control"
        id="exampleInputEmail1" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>


    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" value="<?php echo $row["email"]; ?>" name="email" class="form-control" id="exampleInputEmail1"
        aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" value="<?php echo base64_decode($row["ptoken"]); ?>" name="pswd" class="form-control"
        id="exampleInputPassword1">
    </div>

    <div class="mb-3">
      <label for="file">IMAGE</label>
      <input type="file" id="file" name="profile" class="form-control" aria-label="file example" >

      <img src="<?php echo $row2["image"]  ?>" width="100" height="100" alt="" srcset="">
    </div>

    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <input type="submit" name="update" class="btn btn-primary " value="UPDATE">
  </form>



  <?php

} else {
  redirect_url(HOME);

}
?>


<?php

// $a["email"]


require_once dirname(__FILE__) . "/layout/user/footer.php";
?>