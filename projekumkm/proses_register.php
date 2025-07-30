<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$email    = $_POST['email']; 

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Cek apakah username atau email sudah ada
$cek = mysqli_query($conn, "SELECT * FROM data2 WHERE username='$username' OR email='$email'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username atau Email sudah terdaftar');window.location='register.php';</script>";
} else {
    // Simpan data
    $simpan = mysqli_query($conn, "INSERT INTO data2 (username, password, email) VALUES ('$username', '$hashed_password', '$email')");
    if ($simpan) {
        echo "<script>alert('Registrasi berhasil. Silakan login!');window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal');window.location='register.php';</script>";
    }
}
?>