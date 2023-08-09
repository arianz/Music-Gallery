<!DOCTYPE html>
<html lang="en">
<head>
    <style data-merge-styles="true"></style>
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
    <script> var _base_url_ = 'http://localhost/tugas_pemweb/';</script>
    <script src="library/script.js"></script>
</head>  
<body class="layout-top-nav layout-fixed control-sidebar-slide-open layout-navbar-fixed text-sm" data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="">
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
          <a class="navbar-brand" href="">
            <img src="music_banner/logo.png" width="30" height="30" class="d-inline-block align-top rounded-circle" alt="" loading="lazy">
              Music Gallery
          </a>
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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-3"> 
        <!-- Main content -->
        <section class="content">
          <div class="container container-md-fluid container-sm-fluid">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-auto my-5 py-5">
                <div class="card shadow rounded-0">
                  <div class="card-body rounded-0">
                    <div class="container-fluid">
                      <h1>Welcome to Music Gallery!</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>
    <!-- Footer-->
    <footer class="py-3 bg-gradient-blue">
      <p class="m-0 text-center">Copyright © MGS - PHP 2023</p>
    </footer>
    <script> $.widget.bridge('uibutton', $.ui.button)</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
  </div>  
</body>
</html>