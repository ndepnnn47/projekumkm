<?php
$conn = new mysqli("localhost", "root", "", "umkm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>