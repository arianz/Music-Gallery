<?php
    session_start();
    require '../initialize.php';
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    $cek = mysqli_num_rows($result);

    if($cek > 0){
        $sesi = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $sesi['id'];
        $_SESSION['nama'] = $sesi['username'];
        $_SESSION['status'] = "login";
        header("location:home.php");
        exit();
    }else{
        $error = "Username atau Password Salah!";
        header("location:login.php?pesan=gagal&error=" . urlencode($error));
        exit();
    }
?>
