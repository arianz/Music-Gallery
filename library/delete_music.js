function deleteMusic(id) {
    Swal.fire({
        title: 'Delete Music',
        text: 'Are you sure you want to delete this music?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send AJAX request to delete the music
            $.ajax({
                url: 'delete_music.php', 
                method: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The music has been deleted.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            // Redirect to the music list page after successful deletion
                            window.location.href = 'musics.php'; // Replace with the URL of your music list page
                        });
                    } else {
                        Swal.fire('Error', 'An error occurred while deleting the music.', 'error');
                    }
                },
                error: function(err) {
                    Swal.fire('Error', 'An error occurred while processing the request.', 'error');
                    console.error(err);
                }
            });
        }
    });
}

// Add event listener to the delete button
$(document).ready(function() {
    $('.delete_data').on('click', function() {
        var musicId = $(this).data('musicid');
        deleteMusic(musicId);
    });
});

