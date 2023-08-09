function showConfirmModal(categoryId) {
    $("#delete_content").html("Are you sure you want to delete this category?");
    $("#confirm").attr("onclick", "deleteCategory(" + categoryId + ")");
    $("#confirm_modal").modal("show");
}

	// Function to delete the category
    function deleteCategory(categoryId) {
        // Perform the deletion using AJAX
        $.ajax({
            url: "delete_category.php",
            method: "POST",
            data: { id: categoryId },
            success: function (response) {
                // Refresh the page after successful deletion
                location.reload();
            },
            error: function (xhr, status, error) {
                alert("Error deleting category: " + xhr.responseText);
            },
        });
    }

    $(document).on("click", ".edit-data", function() {
        var categoryId = $(this).data("id");
        $.ajax({
          url: "fetch_category.php", // Create a separate PHP file to fetch category details
          type: "POST",
          data: { category_id: categoryId },
          success: function(response) {
            var categoryData = JSON.parse(response);
            showEditModal(categoryData);
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
        });
    });
    
      // Function to display the edit modal
      function showEditModal(categoryData) {
        var modal = $("#edit_modal");
        modal.find(".modal-title").text("Edit Category");
        modal.find(".modal-body").html(`
          <form id="edit_form">
            <input type="hidden" name="category_id" value="${categoryData.id}">
            <div class="form-group">
              <label for="edit_name">Name</label>
              <input type="text" class="form-control" id="edit_name" name="edit_name" value="${categoryData.name}" required>
            </div>
            <div class="form-group">
              <label for="edit_description">Description</label>
              <textarea class="form-control" id="edit_description" name="edit_description">${categoryData.description}</textarea>
            </div>
          </form>
        `);
        modal.modal("show");
        modal.find("#submit_edit").on("click", function () {
            event.preventDefault();
            updateCategory(categoryData.id);
          });
      }

      $(document).on("click", "#submit_edit", function (e) {
        e.preventDefault(); // Prevent the default form submission behavior
        updateCategory(categoryData.id);
    });
    
      // When the edit form is submitted, handle the update process and show the result
      function updateCategory(categoryId) {
        var editForm = $("#edit_form");
        var formData = editForm.serialize();
      
        $.ajax({
          url: "update_category.php",
          type: "POST",
          data: formData,
          success: function (response) {
            var result = JSON.parse(response);
            var message = result.success
              ? "Category updated successfully!"
              : "Failed to update category.";
            showResultModal(message);
            // Optionally, you can reload the table after successful update
            // $('.table').DataTable().ajax.reload();
          },
          error: function (xhr, status, error) {
            console.log(error);
          },
          complete: function () {
            // Close the edit modal after completing the request
            $("#edit_modal").modal("hide");
          },
        });
      
        // Close the edit modal after submitting the update
        $("#edit_modal").modal("hide");
      }
    
      // Function to display the result modal
      function showResultModal(message) {
        var modal = $("#result_modal");
        modal.find(".modal-body").text(message);
        modal.modal("show");
      }

      $(document).ready(function() {
        // Event listener for the "Add New" button
        $("#create_new").on("click", function() {
          // Clear the modal inputs
          $("#category_name").val("");
          $("#category_description").val("");
          $("#category_id").val("");
    
          // Show the modal
          $("#addCategoryModal").modal("show");
        });
    
        // Event listener for the "Save" button inside the modal
        $("#submit_new_category").on("click", function() {
          // Get the input values
          var categoryName = $("#category_name").val();
          var categoryDescription = $("#category_description").val();
          var category_id = $("#category_id").val();
    
          // Send the data to the backend PHP script using AJAX
          $.ajax({
            url: "add_category.php", // Replace with the actual PHP script file name
            type: "POST",
            data: {
              name: categoryName,
              description: categoryDescription,
              category_id: category_id
            },
            success: function(data) {
              // Handle the response from the server (if needed)
              // For example, show a success message or refresh the category list
              console.log(data); // You can remove this line or use it to debug if needed
              Swal.fire({
                icon: 'success',
                title: 'Category Added',
                text: 'The new category has been added successfully!',
                showConfirmButton: false,
                timer: 2000 // The success message will be automatically closed after 2 seconds
              });
            },
            error: function(xhr, status, error) {
              // Handle any error that occurred during the AJAX request (if needed)
              console.error(error);
            }
          });
    
          // Close the modal
          $("#addCategoryModal").modal("hide");
        });
      });

    $(document).ready(function(){
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [5] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
})

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