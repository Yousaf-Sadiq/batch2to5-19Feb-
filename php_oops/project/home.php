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
<style>
   .dt-paging-button {
      color: white;
   }
</style>

<div class="table-responsive p-5 " style="background-color:#2222 ;">

   <table id="myTable" class="display nowrap table-bordered text-bg-dark table table-dark table-hover">
      <!-- <table id="myTable"> -->
      <thead>

         <tr>
            <th>id</th>
            <th>USerName</th>
            <th>Email</th>
            <th>ACTION</th>
         </tr>

      </thead>

      <tbody></tbody>

   </table>



   <!-- Modal -->
   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-bg-dark">
               <form action="" method="post">
                  <input type="hidden" id="user_id" name="user_id">
                  <input type="hidden" id="update" name="update" value="update">
                  <div class="mb-3">
                     <label for="exampleInputEmail1" class="form-label">Email address</label>
                     <input type="email" name="email" class="form-control" id="emails" aria-describedby="emailHelp">

                  </div>
                  <div class="mb-3">
                     <label for="exampleInputPassword1" class="form-label">User name</label>
                     <input type="text" name="user_name" class="form-control" id="us_name">

                  </div>

                  <button type="submit" class="btn btn-primary">SUBMIT</button>
               </form>
            </div>
            <div class="modal-footer">
               <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
               <!-- <button type="button" class="btn btn-primary">Understood</button> -->
            </div>
         </div>
      </div>
   </div>

</div>

<?php

require_once dirname(__FILE__) . "/layout/footer.php";
?>

<script>

   $(document).ready(function () {

      let table = document.querySelector("#myTable");


      $(table).DataTable({
         processing: true,
         serverSide: true,
         // dom: 'Bfrtip',
         // buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],

         ajax: {
            url: "<?php echo GetUSer ?>",
            "type": "POST",
         },
         "datasrc": ""

         , "columns": [
            { "data": "id" },
            { "data": "user_name" },
            { "data": "email" },
            {
               "data": null,
               "render": function (data, row, type) {
                  let html = `<button onclick="OnEdit('${data.id}','${data.email}','${data.user_name}')" class="btn btn-small text-bg-info"> EDIT </button>
                     <button onclick="Ondelete('${data.id}')" type="button" class="btn btn-small text-bg-danger"> DELETE </button>`
                  return html
               }
            }
         ]

      });


   })

   function Ondelete(id) {
      console.log("delete"+ id)
   }

   function OnEdit(id, email, user_name) {

      const myModal = new bootstrap.Modal('#staticBackdrop', {
         keyboard: false
      })

      const mine = document.getElementById('staticBackdrop'); 
      
      myModal.show(mine)
   
      let userid=document.querySelector("#user_id");
      let Email=document.querySelector("#emails");
      let User_name=document.querySelector("#us_name");


      userid.value= id
      Email.value= email
      User_name.value= user_name
   
   }







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