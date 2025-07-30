<?php
session_start();
session_destroy();
header("Location: index.php"); // UBAH DARI login.php KE index.php
exit();
?>
