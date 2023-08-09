$(document).ready(function() {
    // Function to populate the modal with user data
    function populateEditModal(userId, username, password) {
      $('#editUserId').val(userId);
      $('#editUsername').val(username);
      $('#editPassword').val(password);
    }

    // Open the modal and populate it with the user's data on button click
    $('.edit_data').on('click', function() {
      const userId = $(this).data('id');
      const username = $(this).data('username');
      const password = $(this).data('password');
      populateEditModal(userId, username, password);
      $('#editUserModal').modal('show');
    });

    // Handle form submission for editing user data
    $('#editUserForm').on('submit', function(e) {
      e.preventDefault();
      const userId = $('#editUserId').val();
      const username = $('#editUsername').val();
      const password = $('#editPassword').val();

      // Send AJAX request to update user data in the database
      $.ajax({
        url: 'update_user.php', // Replace with the URL of your PHP script to update user data
        type: 'POST',
        data: {
          userId: userId,
          username: username,
          password: password
        },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                // Show success notification using SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                    timer: 2000, // Show the notification for 2 seconds
                    showConfirmButton: false
                }).then(() => {
                    // You can also redirect back to the user.php page after showing the notification
                    window.location.href = 'user.php';
                });
            } else {
                // Show error notification using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        },
        error: function(error) {
          // Handle the error response, e.g., display an error message
          console.error('Error updating user:', error.responseText);
          alert('Error updating user. Please try again.');
        }
      });
    });
});

$(document).ready(function(){
    window.viewer_modal = function($src = ''){
     start_loader()
     var t = $src.split('.')
     t = t[1]
     if(t =='mp4'){
       var view = $("<video src='"+$src+"' controls autoplay></video>")
     }else{
       var view = $("<img src='"+$src+"' />")
     }
     $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
     $('#viewer_modal .modal-content').append(view)
     $('#viewer_modal').modal({
             show:true,
             backdrop:'static',
             keyboard:false,
             focus:true
           })
           end_loader()  

 }
   window.uni_modal = function($title = '' , $url='',$size=""){
       start_loader()
       $.ajax({
           url:$url,
           error:err=>{
               console.log()
               alert("An error occured")
           },
           success:function(resp){
               if(resp){
                   $('#uni_modal .modal-title').html($title)
                   $('#uni_modal .modal-body').html(resp)
                   if($size != ''){
                       $('#uni_modal .modal-dialog').addClass($size+'  modal-dialog-centered')
                   }else{
                       $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered")
                   }
                   $('#uni_modal').modal({
                     show:true,
                     backdrop:'static',
                     keyboard:false,
                     focus:true
                   })
                   end_loader()
               }
           }
       })
   }
   window._conf = function($msg='',$func='',$params = []){
      $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
      $('#confirm_modal .modal-body').html($msg)
      $('#confirm_modal').modal('show')
   }
 })