<?php

require_once dirname(__FILE__) . "/layout/user/header.php";


if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {

 redirect_url(HOME);
}

?>
<h1>DASHBOARD</h1>


<?php
$user_id_session=$_SESSION["user_id"];

$fetch_sql = "SELECT * FROM `users`  WHERE `user_id` ='{$user_id_session}'";

$qwer = $conn->query($fetch_sql);

if ($qwer->num_rows > 0) {
  ?>


  <style>
    th {
      text-align: center;
    }
  </style>
  <div class="table-responsive">
    <table class="table table-dark table-hover text-center">
      <tbody>
        <tr class="">
          <th scope="row">#</th>
          <th>Profile</th>
          <th>NAME</th>
          <th>Email</th>
          <th>Address</th>
          <th>CONTACT</th>
          <th>Action</th>
        </tr>


        <!-- ================================ -->
        <?php
        while ($row = $qwer->fetch_assoc()) {

          $fetch_sql2 = "SELECT * FROM `user_address` WHERE `user_id`='{$row["user_id"]}'";

          $qwer2 = $conn->query($fetch_sql2);
          $default = [
            "image" => domain . "/asset/upload/default.jpg",
            "address" => "none",
            "contact" => "1234"
          ];

          if ($qwer2->num_rows > 0) {
            $row2 = $qwer2->fetch_assoc();
          } else {
            $row2 = $default;
          }


          ?>

          <tr>
            <td> 1</td>
            <td class="w-25">
              <?php
              if (isset($row2["image"]) && !empty($row2["image"])) {
                # code...
          
                ?>
                <a href="<?php echo $row2["image"] ?>">
                  <picture>
                    <source srcset="<?php echo $row2["image"] ?>" type="image/svg+xml">
                    <img src="<?php echo $row2["image"] ?>" class="w-50 img-fluid img-thumbnail" alt="...">
                  </picture>
                </a>
              <?php } else {
                ?>
                <a href="<?php echo $default["image"] ?>">
                  <picture>
                    <source srcset="<?php echo $default["image"] ?>" type="image/svg+xml">
                    <img src="<?php echo $default["image"] ?>" class="w-50 img-fluid img-thumbnail" alt="...">
                  </picture>

                </a>

              <?php } ?>

            </td>
            <td> <?php echo $row["user_name"] ?> </td>
            <td> <?php echo $row["email"] ?> </td>
            <td> <?php

            if (isset($row2["address"]) && !empty($row2["address"])) {
              # code...
        
              echo $row2["address"];
              ?>




              <?php } else {

              echo $default["address"];
              ?>

              <?php } ?>

            </td>

            <td> <?php

            if (isset($row2["contact"]) && !empty($row2["contact"])) {
              # code...
        
              echo $row2["contact"];
              ?>




              <?php } else {

              echo $default["contact"];
              ?>

              <?php } ?>

            </td>
            <td>
              <div class="card text-bg-dark">
                <div class="card-body d-flex flex-wrap justify-content-center">



                  <a href="<?php echo update ?>?q=<?php echo $row["user_id"] ?>" style="font-weight: bolder;"
                    class=" link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    UPDATE</a>


                  <span> &ensp;&ensp;&ensp;|&ensp;&ensp;&ensp;</span>
                 
                  <a href="#" style="font-weight: bolder;" 
                  
                  data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                    
                  data-abc="<?php echo $row["user_id"] ?>"
                   
                   
                    class="delete link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    DELETE</a>


                </div>
              </div>

            </td>
          </tr>


        <?php } ?>
        <!-- ================================ -->
      </tbody>
    </table>
  </div>
  <?php

} else {
  ?>

  <h1> DATA NOT FOUND</h1>


<?php } ?>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">DELETE </h1>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        <h1>ARE YOU SURE <span class="text-danger">!</span></h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>


        <form action="<?php echo delete_form ?>" method="post">

          <input type="hidden" name="user_id" id="user_id">

          <input type="submit" name="delete" class="btn btn-primary" value="YES/understood">

        </form>



      </div>
    </div>
  </div>
</div>

<?php

// $a["email"]


require_once dirname(__FILE__) . "/layout/user/footer.php";
?>

<script>

  let del = document.querySelectorAll(".delete");

  del.forEach(function (delet) {

    delet.addEventListener("click", function () {

      console.log(this.dataset.abc)

      user_id.value =this.dataset.abc ;

      
    });
  })

</script>