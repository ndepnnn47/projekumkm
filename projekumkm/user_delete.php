<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "Akses ditolak.";
    exit();
}

$id = $_GET['id'];
$conn->query("DELETE FROM data2 WHERE id=$id");

header("Location: user_show.php");
exit();
?>