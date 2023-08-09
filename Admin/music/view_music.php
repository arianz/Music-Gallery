<?php
    require_once "../../initialize.php";
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "SELECT m.id, m.title, m.artist, m.category_id, m.description, m.banner_path, m.audio_path, m.status, c.name FROM `music_list` AS m 
    JOIN `category_list` AS c WHERE m.category_id = c.category_id AND m.id = $id";
    $result = $conn->query($sql);
    $songs = array();

    if ($result->num_rows > 0) {
        $songs = $result->fetch_assoc(); // Fetch the first row since we are querying by ID, and there should be only one result.
    }

    // Initialize the session
    session_start();
    $namaAkun = $_SESSION['nama'];
    $id_akun = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>Music Gallery Site - PHP</title>
    <link rel="icon" href="../../music_banner/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../library/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.12.0/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css">
    <style type="text/css">/* Chart.js */
      @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
    <script>var _base_url_ = 'http://localhost/tugas_pemweb/';</script>
    <script src="../../library/script.js"></script>
    <script src="../../library/manage_music.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
</head>
<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs text-sm dark-mode" data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;">
    <div class="wrapper">
        <style>
        .user-img{
                position: absolute;
                height: 27px;
                width: 27px;
                object-fit: cover;
                left: -7%;
                top: -12%;
        }
        .btn-rounded{
                border-radius: 50px;
        }
        </style>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark shadow text-sm">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link">Music Gallery Site - PHP - Admin</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item">
                    <div class="btn-group nav-link">
                        <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span><img src="../../music_banner/user_profile.png" class="img-circle elevation-2 user-img" alt="User Image"></span>
                            <span class="ml-4"><?php echo $namaAkun; ?></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="../my_account.php"><span class="fa fa-user"></span> My Account</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../login.php?f=logout"><span class="fas fa-sign-out-alt"></span> Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->     
        <style>
        .sidebar a.nav-link.active{
            color:#fff !important
        }
        </style>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-purple navbar-dark elevation-4 sidebar-no-expand">
            <!-- Brand Logo -->
            <a href="../../index.php" class="brand-link bg-purple text-sm">
                <img src="../../music_banner/logo.png" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 1.5rem;height: 1.5rem;max-height: unset">
                <span class="brand-text font-weight-light">MGS - PHP</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
                <div class="os-resize-observer-host observed">
                    <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
                </div>
                
                <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
                    <div class="os-resize-observer"></div>
                </div>
                <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
                <div class="os-padding">
                    <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                        <!-- Sidebar user panel (optional) -->
                            <div class="clearfix"></div>
                            <!-- Sidebar Menu -->
                            <nav class="mt-1">
                                <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                                    <li class="nav-item dropdown">
                                        <a href="../home.php" class="nav-link">
                                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                            <p>Dashboard</p>
                                        </a>
                                    </li> 
                                    <li class="nav-item dropdown">
                                        <a href="../category/categoryadmin.php" class="nav-link nav-categories">
                                            <i class="nav-icon fas fa-th-list"></i>
                                            <p>Category List</p>
                                        </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-music"></i>
                                            <p>Music<i class="right fas fa-angle-left"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview" style="display: none;">
                                            <li class="nav-item">
                                                <a href="./manage_music.php" class="nav-link tree-item nav-musics-manage_music">
                                                    <i class="fa fa-plus nav-icon"></i>
                                                    <p>Add New</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="./musics.php" class="nav-link tree-item nav-musics">
                                                    <i class="fa fa-sliders-h nav-icon"></i>
                                                    <p>List</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>                 
                                    <li class="nav-header">Maintenance</li>
                                    <li class="nav-item dropdown">
                                        <a href="../users/user.php" class="nav-link nav-user_list">
                                            <i class="nav-icon fas fa-users-cog"></i>
                                            <p>User List</p>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- /.sidebar-menu -->
                        </div>
                    </div>
                </div>
                <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                    <div class="os-scrollbar-track">
                        <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
                    </div>
                </div>
                <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
                    <div class="os-scrollbar-track">
                        <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
                    </div>
                </div>
                <div class="os-scrollbar-corner"></div>
            </div>
            <!-- /.sidebar -->
        </aside>         
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper  pt-3" style="min-height: 567.854px;">
            <!-- Main content -->
            <div class="card card-outline rounded-0 card-purple">
                <div class="card-header">
                    <h3 class="card-title">Music Details</h3>
                    <div class="card-tools">
                        <button id="delete_data" data-musicid="<?php echo $song['id']; ?>" type="button" class="btn btn-flat btn-danger bg-danger"><span class="fas fa-trash"></span>  Delete</button>
                        <a href="musics.php" class="btn btn-flat btn-light bg-light"><span class="fas fa-angle-left"></span>  Back to List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="title" class="control-label">Title:</label>
                            <div class="pl-4"><?php echo $songs['title']; ?></div>
                        </div>
                        <div class="form-group">
                            <label for="artist" class="control-label">Artist</label>
                            <div class="pl-4"><?php echo $songs['artist']; ?></div>
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="control-label">Category</label>
                            <div class="pl-4"><?php echo $songs['name']; ?></div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <div class="pl-4"><?php echo $songs['description']; ?></div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Music Banner (500 x 500)</label>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <img src="../../<?php echo $songs['banner_path']; ?>" alt="" id="BannerViewer" class="img-fluid img-thumbnail bg-gradient-dark border-dark">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Audio File</label>
                            <?php if(isset($songs['audio_path']) && !empty($songs['audio_path'])): ?>
                                <div class="pl-4">
                                    <audio src="../../<?php echo $songs['audio_path']; ?>" controls></audio>
                                </div>
                                <div class="pl-4">
                                    <a href="../../<?php echo $songs['audio_path']; ?>" target="_blank"><?php echo $songs['audio_path']; ?></a>
                                </div>
                            <?php else: ?>
                                <div class="pl-4"><span class="text-muted">No Audio File Added.</span></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label">Status</label>
                            <select name="status" id="status" class="form-control form-control-sm rounded-0" required="required">
                            <?php
                            $status_options = array(
                                0 => 'Inactive',
                                1 => 'Active'
                            );
                            $existing_status = isset($songs['status']) ? $songs['status'] : ''; // Assuming "$songs['status']" contains the value fetched from the database.
                            foreach ($status_options as $value => $label) {
                                $selected = ($value == $existing_status) ? 'selected="selected"' : '';
                                echo '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer text-sm">
            <strong>Copyright © 2023.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <script>$.widget.bridge('uibutton', $.ui.button)</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <div class="jqvmap-label" style="display: none; left: 1093.83px; top: 394.361px;">Idaho</div>  
</body>
</html>

<script>
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
                    url: 'delete_music.php', // Replace with the URL of your PHP file to handle the delete request
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
        $('#delete_data').on('click', function() {
            var musicId = <?php echo $id; ?>;
            deleteMusic(musicId);
        });
    });
</script>
