<?php 
include 'initialize.php';
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the category ID from the URL query parameters
$categoryID = $_GET['category_id'] ?? null;

// Modify the SQL query to fetch songs only for the selected category
$sql = "SELECT * FROM music_list";
if (!empty($categoryID)) {
    $sql .= " WHERE category_id = $categoryID";
}

$result = $conn->query($sql);
$songs = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
}
$conn->close(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>Music Gallery Site - PHP</title>
    <link rel="icon" href="music_banner/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="library/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.12.0/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <style type="text/css">/* Chart.js */
      @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
    <script>var _base_url_ = 'http://localhost/tugas_pemweb/';</script>
    <script src="library/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="stylesheet" href="library/music_list.css">
</head>  
<body class="layout-top-nav layout-fixed control-sidebar-slide-open layout-navbar-fixed text-sm" data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;">
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
        .user-dd:hover{
            color:#fff !important
        }
        </style>
        <nav class="main-header navbar navbar-expand-lg navbar-dark bg-gradient-primary">
            <div class="container container-md-fluid container-sm-fluid px-4 px-lg-5 ">
                <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <a class="navbar-brand" href="./">
                <img src="music_banner/logo.png" width="30" height="30" class="d-inline-block align-top rounded-circle" alt="" loading="lazy">
                Music Gallery</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link text-white" aria-current="page" href="./">Home</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="categories.php">Categories</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="music_list.php">Gallery</a></li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="Admin/">Admin Panel</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="content-wrapper  pt-3" style="min-height: 451.333px;">
            <section class="content">
                <div class="container container-md-fluid container-sm-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 mx-auto mt-5 mb-3 ">
                            <h1 class="text-center">Music List</h1>
                            <hr class="mx-auto bg-primary opacity-100" style="height:2px;opacity:1;width:20%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 mx-auto mb-5">
                            <div class="input-group mb-3">
                                <input type="search" id="search_cat" placeholder="Search Here" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-auto mb-5">
                            <div class="row">
                                <?php foreach ($songs as $song) { ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 my-3 cat-items">
                                        <div class="card rounded-0 card-outline card-primary  h-100">
                                            <div class="card-img-top music-banner"><img src="<?php echo $song['banner_path']; ?>" alt="<?php echo $song['description']; ?>"></div>
                                            <div class="card-body rounded-0">
                                                <div class="container-fluid">
                                                    <div><h2 class="rounded-0 text-center w-100"><b><?php echo $song['title']; ?></b></h2></div>
                                                    <div>
                                                        <div class="truncate text-center"><?php echo $song['artist']; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <div class="row justify-content-end">
                                                    <a href="<?php echo $song['audio_path'] ?>" download="<?= $song['title'].".".(pathinfo($song['audio_path'], PATHINFO_EXTENSION)) ?>" class="btn btn-sm btn-outline-success rounded-circle p-0 music-btns"><i class="fa fa-download"></i></a>
                                                    <a href="javascript:void(0)" data-id="<?php echo $song['id']; ?>" data-audio="<?php echo $song['audio_path']; ?>" class="btn btn-sm btn-outline-primary rounded-circle p-0 music-btns play_music"><i class="fa fa-play"></i></a>
                                                    <a href="javascript:void(0)" data-id="<?php echo $song['id']; ?>" class="btn btn-sm btn-outline-info rounded-circle p-0 music-btns view_music_details"><i class="fa fa-info"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>     
                                <?php } ?>
                                <div id="player-field">
                                <div>
                                    <div id="player-img-holder">
                                        <img src="music_banner/logo.png" alt="">
                                    </div>
                                </div>
                                <div>
                                    <button class="play-btn" id="play" type="button"><i class="fa fa-play"></i></button>
                                </div>
                                <div id="player-slider">
                                    <div id="music-title" class="text-light"><span id="title"></span> - <span class="mx-4 text-muted" id="artist"></span></div>
                                    <div id="progress-container">
                                        <div id="progress"></div>
                                    </div>
                                    <div id="timer-bar">
                                        <span id="timer">0:00</span>
                                        <span id="duration"></span>
                                    </div>
                                </div>
                                <div id="volume-control" class="px-2">
                                    <a href="javascript:void(0)" id="volume-down" class="text-muted mx-2"><i class="fa fa-volume-down"></i></a>
                                    <a href="javascript:void(0)" id="volume-up" class="text-muted mx-2"><i class="fa fa-volume-up"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <audio src="" class="d-none" id="player-el"></audio>      
                </div>
            </section>
            <!-- /.content -->
            <div class="modal fade" id="uni_modal" role="dialog">
                <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable rounded-0" role="document">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <a class="text-muted" href="javascript:void(0)" data-dismiss="modal"><i class="fa fa-times"></i></a>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary rounded-0" id="submit" onclick="$('#uni_modal form').submit()">Save</button>
                            <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="uni_modal_right" role="dialog">
                <div class="modal-dialog modal-full-height  modal-md rounded-0" role="document">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="fa fa-arrow-right"></span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="confirm_modal" role="dialog">
                <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirmation</h5>
                        </div>
                        <div class="modal-body">
                            <div id="delete_content"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary rounded-0" id="confirm" onclick="">Continue</button>
                            <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="viewer_modal" role="dialog">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                        <img src="" alt="">
                    </div>
                </div>
            </div>
        </div>
        <footer class="py-3 bg-gradient-blue">
            <p class="m-0 text-center text-white">Copyright © MGS - PHP 2023</p>
        </footer>
        <script>$.widget.bridge('uibutton', $.ui.button)</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.com/libraries/Chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
        <script src="library/music_list.js"></script>
    </div>
</body>
</html>