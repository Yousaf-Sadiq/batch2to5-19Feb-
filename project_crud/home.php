<?php

require_once dirname(__FILE__) . "/layout/user/header.php";


?>
<h1>HOME</h1>

<form action="<?php echo insert_form ?>" class="text-bg-dark p-5 m-5" method="POST">

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="pswd" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <input type="submit" name="insert" class="btn btn-primary " value="INSERT">
</form>





<?php
$fetch_sql = "SELECT * FROM `users`";

$qwer = $conn->query($fetch_sql);

if ($qwer->num_rows > 0) {
  ?>


  <style>
    th {
      text-align: center;
    }
  </style>
  <div class="table-responsive">
    <table class="table table-dark table-hover">
      <tbody>
        <tr class="">
          <th scope="row">#</th>
          <th>NAME</th>
          <th>Email</th>
          <th>Action</th>
        </tr>


        <!-- ================================ -->
        <?php
        while ($row = $qwer->fetch_assoc()) {


          ?>

          <tr>
            <td> 1</td>
            <td> <?php echo $row["user_name"] ?> </td>
            <td> <?php echo $row["email"] ?> </td>
            <td>
              <div class="card text-bg-dark">
                <div class="card-body d-flex flex-wrap justify-content-center">
                  
              

                <a href="<?php echo update ?>?q=<?php echo $row["user_id"]  ?>"
                  
                  style="font-weight: bolder;"
                    class=" link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    UPDATE</a>


                  <span> &ensp;&ensp;&ensp;|&ensp;&ensp;&ensp;</span>
                  <a href="#"
                  
                  style="font-weight: bolder;"
                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
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
<?php

// $a["email"]


require_once dirname(__FILE__) . "/layout/user/footer.php";
?>