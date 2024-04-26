
  <!-- Bootstrap JavaScript Libraries -->
  <script
   src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
   integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
   crossorigin="anonymous"
  ></script>

  <script
   src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
   integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
   crossorigin="anonymous"
  ></script>
<script>
  
 function Error_msg(msg, id) {

const alertPlaceholder = document.getElementById(id)


const appendAlert = (message, type) => {

 const wrapper = document.createElement('div')
 
 wrapper.innerHTML = [
  `<div class="alert alert-${type} alert-dismissible myclose" role="alert">`,
  `   <div>${message}</div>`,
  '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
  '</div>'
 ].join('')

 alertPlaceholder.append(wrapper)
}


// call alert message
appendAlert(`${msg}`, 'danger')
}




function success_msg(msg, id) {

const alertPlaceholder = document.getElementById(id)


const appendAlert = (message, type) => {
 const wrapper = document.createElement('div')
 wrapper.innerHTML = [
  `<div class="alert alert-${type} alert-dismissible myclose" role="alert">`,
  `   <div>${message}</div>`,
  '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
  '</div>'
 ].join('')

 alertPlaceholder.append(wrapper)
}


// call alert message
appendAlert(`${msg}`, 'success')
}



</script> 

</body>
</html>
