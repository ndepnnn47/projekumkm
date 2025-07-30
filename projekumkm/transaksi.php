<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CDN -->    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #150c34;
            margin: 0;
            padding: 0;
            color: #ffffff;
        }

        /* Sidebar */
        #sidebar-wrapper {
            background: linear-gradient(160deg, #301eb5ff, #5e35b1);
            width: 250px;
            height: 100vh;
            padding-top: 20px;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.4);
            transition: margin 0.3s ease;
        }

            .sidebar-heading {
            color: #ffe76d;
            text-shadow: 0 0 2px #ffe76d, 0 0 4px #ffef99;
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }



        .list-group-item {
            background-color: transparent !important;
            color: #e0d3ff !important;
            border: none;
            font-size: 1rem;
            padding: 15px 25px;
            transition: all 0.2s ease-in-out;
        }

        .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #ffe76d !important;
            border-left: 5px solid #ffe76d;
        }

        .logout-btn {
            color: #ff4e00 !important; /* Merah terang */
        }

        .logout-btn:hover {
            background-color: rgba(255, 165, 0, 0.1) !important; /* Orange muda transparan */
            color: #ff4e00 !important; /* Tetap merah saat hover */
            border-left: 5px solid #ff9500; /* Garis tepi oranye */
        }

        /* Glow effect */
        .glow {
            box-shadow: 0 0 20px rgba(162, 68, 255, 0.8);
            transition: 0.3s ease-in-out;
        }

            .glow-text {
            color: #ffe76d;
            text-shadow: 0 0 2px #ffe76d, 0 0 4px #ffef99;
        }


        /* Page content */
        #page-content-wrapper {
            flex: 1;
            background-color: #1a1446;
            padding: 30px;
        }

        /* Navbar */
        .navbar {
            background-color: #471e9aff !important;
            box-shadow: 0 0px 1px rgba(0, 0, 0, 0.4);
        }

        .navbar h5,
        .navbar span {
            color: #ffe76d;
            text-shadow: 0 0 0px #ffe76d, 0 0 4px #ffef99;
            font-weight: bold;
        }



        /* Toggle Button */
        #menu-toggle {
            background-color: #5e35b1;
            border: none;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            transition: 0.2s;
        }

        #menu-toggle:hover {
            background-color: #7744e6;
        }

        /* Card Custom */
        .card {
            border: none;
            border-radius: 15px;
            padding: 20px;
            background: linear-gradient(to bottom right, #301eb5ff, #5d1cc5ff);
            color: #fff;
            box-shadow: 0 0 12px rgba(95, 39, 205, 0.5);
            transition: 0.3s ease;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 0 20px rgba(255, 231, 109, 0.4);
        }

        .card h5 {
            font-size: 1.1rem;
            color: #ffe76d;
            text-shadow: 0 0 0px #ffe76d, 0 0 10px #ffe76d, 0 0 20px #ffef99;
        }


        .card .fs-4 {
            font-size: 1.8rem;
            font-weight: bold;
        }

        /* Toggle Sidebar CSS */
        #wrapper.toggled #sidebar-wrapper {
            margin-left: -250px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #wrapper {
                flex-direction: column;
            }

            #sidebar-wrapper {
                width: 100%;
                height: auto;
                position: relative;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark border-end" id="sidebar-wrapper">
        <div class="text-white text-center py-4 d-flex flex-column align-items-center">
            <img src="img/medu.jpg" width="170" height="120" class="rounded-3 object-fit-cover border border-primary mb-2 glow">
            <h4 class="mb-0">Admin Panel</h4>
        </div>

        <div class="list-group list-group-flush px-2 mt-3">
            <a href="" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a href="user_show.php" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="fas fa-users me-2"></i> Kelola User
            </a>
            <a href="produk2.php" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="fas fa-box me-2"></i> Produk
            </a>
            <a href="transaksi.php" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="fas fa-receipt me-2"></i> Transaksi
            </a>
            <a href="pelanggan.php" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="fas fa-user-check me-2"></i> Pelanggan
            </a>
            <!-- UBAH BARIS INI -->
            <a href="logout.php" class="list-group-item list-group-item-action bg-dark text-white logout-btn">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
        </div>
    </div>

    <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <button class="btn btn-dark" id="menu-toggle"><i class="fas fa-bars"></i></button>
                <h5 class="ms-3 mb-0">Dashboard Admin</h5>
                <div class="ms-auto">
                    <span class="me-3">Halo, <?= $_SESSION['username']; ?></span>
                </div>
            </div>
        </nav>

        <!-- Main Content -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle sidebar
    document.getElementById("menu-toggle").addEventListener("click", function () {
        document.getElementById("wrapper").classList.toggle("toggled");
    });
</script>
</body>
</html>