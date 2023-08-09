function displayBanner(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            _this.siblings('.custom-file-label').html(input.files[0].name)
            $('#BannerViewer').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }else{
        _this.siblings('.custom-file-label').html("Choose File")

    }
}
function displayAudioName(input,_this){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            _this.siblings('.custom-file-label').html(input.files[0].name)
        }

        reader.readAsDataURL(input.files[0]);
    }else{
        _this.siblings('.custom-file-label').html("Choose File")
    }
}
function updateMusicData(formData) {
    $.ajax({
        url: 'update_music.php?id=' + formData.get('id'), // Pass the 'id' parameter in the URL
        type: 'POST',
        data: formData,
        dataType: 'json', // Expect JSON response from the server
        contentType: false, // Set to false to let jQuery handle the content type
        processData: false, // Set to false to prevent jQuery from processing the data
        success: function(response) {
            if (response.success) {
                alert("Music data updated successfully!");
                window.location.href = 'musics.php'; // Redirect to the music list page on success
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert("An error occurred while saving music data: " + error);
        }
    });
}
$(document).ready(function(){
    $('#category_id').select2({
        placeholder:"Please Select Category Here",
        containerCssClass:"rounded-0"
    })
    $('#update-form').submit(function(e){
        e.preventDefault(); // Prevent the default form submission
        // Create a FormData object to store the form data and file uploads
        var formData = new FormData(this);
        // Call the updateMusicData function to handle the AJAX request
        updateMusicData(formData);
    })
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