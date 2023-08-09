<?php 
include 'initialize.php';
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT name, description, category_id FROM category_list";
$result = $conn->query($sql);

// Store category data in an array
$categories = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
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
      <div class="content-wrapper  pt-3">
        <section class="content">
          <div class="container container-md-fluid container-sm-fluid">            
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 mx-auto mt-5 mb-3 ">
                    <h1 class="text-center">Music Categories</h1>
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
                  <?php foreach ($categories as $category) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3 cat-items">
                        <div class="card rounded-0 card-outline card-primary h-100">
                            <div class="card-header rounded-0">
                                <div class="card-title rounded-0"><b><?php echo $category['name']; ?></b></div>
                            </div>
                            <div class="card-body rounded-0">
                                <div class="container-fluid">
                                    <div class="truncate"><?php echo $category['description']; ?></div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="music_list.php?category_id=<?php echo $category['category_id']; ?>" class="btn btn-sm btn-flat btn-primary bg-gradient-primary">View Category</a>
                            </div>
                        </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <script>
                $(function(){
                    $('#search_cat').on('input change', function(e){
                        e.preventDefault()
                        var _search = $(this).val().toLowerCase()
                        $('.cat-items').each(function(e){
                            var _text = $(this).text().toLowerCase()
                            if(_text.includes(_search) === true){
                                $(this).toggle(true)
                            }else{
                                $(this).toggle(false)
                            }
                        })
                    })
                })
            </script>
          </div>
        </section>
      </div>
      <footer class="py-3 bg-gradient-blue">
        <p class="m-0 text-center">Copyright © MGS - PHP 2023</p>
      </footer>
        <script>$.widget.bridge('uibutton', $.ui.button)</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.com/libraries/Chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
  </div>
</body>
</html>