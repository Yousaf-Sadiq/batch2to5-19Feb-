<?php

require_once dirname(__FILE__) . "/layout/header.php";

// echo insert_form;
?>

<div id="error" class="form-text"></div>

<form id="myform" class="p-5 m-5 text-bg-dark">
 <input type="hidden" name="insert" value="insert">
 <div class="mb-3">
  <label for="exampleInputEmail1" class="form-label">Email address</label>
  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  <div id="email" class="form-text"></div>
 </div>
 <div class="mb-3">
  <label for="exampleInputPassword1" class="form-label">Password</label>
  <input type="password" name="pswd" class="form-control" id="exampleInputPassword1">
  <div id="password" class="form-text"></div>

 </div>
 <div class="mb-3 form-check">
  <input type="checkbox" class="form-check-input" id="exampleCheck1">
  <label class="form-check-label" for="exampleCheck1">Check me out</label>
 </div>
 <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php

require_once dirname(__FILE__) . "/layout/footer.php";
?>

<script>

 let myform = document.querySelector("#myform");

 myform.addEventListener("submit", async function (e) {

  e.preventDefault();

  myform = document.querySelector("#myform");

  let formData = new FormData(myform);


  const options = {
   method: 'POST',
   // headers: {
   //  'Content-Type': 'application/json'
   // },
   body: formData
  };

  const response = await fetch("<?php echo insert_form ?>", options);

  let data = await response.json();

  // console.log(data);

  if (data.error > 0) {
   
   for (const msg of data.msg) {
    Error_msg(msg, "error")
   }


  }
  else {
   console.log(data.msg)

   success_msg(data.msg, "error")



  }




  setTimeout(function () {

   let error = document.querySelectorAll(".myclose")

   console.log(error)
// ===================================================
   error.forEach(e => {

    console.log(e)

    e.style.transition = "all 0.75s ease-in-out"
    e.style.opacity = "0"

    setTimeout(function () {
     e.remove()
    }, 1000)


   });
   // ============================

  }, 1000)


 })






</script>