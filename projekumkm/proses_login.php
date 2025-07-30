<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$email    = $_POST['email']; // Ambil email dari POST
$password = $_POST['password'];

// Cari data dengan username DAN email yang cocok
$sql = "SELECT * FROM data2 WHERE username = ? AND email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email']; // Tambahkan ini untuk menyimpan email ke sesi
        
       if ($user['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: index.php");
    }
        exit();
    } else {
        header("Location: login.php?error=Password salah");
        exit();
    }
} else {
    header("Location: login.php?error=Username ataupun Email tidak cocok");
    exit();
}
?>