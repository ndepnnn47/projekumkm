<?php
session_start();
include "koneksi.php";

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah role-nya admin
if ($_SESSION['role'] != 'admin') {
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Akses Ditolak</title>
        <style>
            body {
                background-color: #0f0a24;
                font-family: Georgia, serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .error-box {
                background: linear-gradient(135deg, #1a1446, #2c1e77, #3e278f);
                padding: 30px;
                border: 2px solid #5e35b1;
                border-radius: 15px;
                text-align: center;
                box-shadow: 0 0 25px rgba(94, 53, 177, 0.4);
                max-width: 400px;
                color: #ffffff;
            }
            h3 {
                color: #ffe96a;
                margin-bottom: 20px;
                font-size: 22px;
                text-shadow: 0 0 4px #ffef9d;
            }
            a {
                display: inline-block;
                padding: 10px 15px;
                background: linear-gradient(to right, #00c9ff, #92fe9d);
                color: #ffffffff;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
                font-family: Georgia, serif;
            }
            a:hover {
                background: linear-gradient(to right, #92fe9d, #00c9ff);
                transform: scale(1.05);
            }
        </style>
    </head>
    <body>
        <div class="error-box">
            <h3>Akses ditolak. Hanya admin yang dapat mengakses halaman ini.</h3>
            <a href="welcome.php">Kembali</a>
        </div>
    </body>
    </html>';
    exit();
}

// Ambil semua user
$sql = "SELECT * FROM data2";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Bootstrap CDN -->    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">


    <title>Manajemen User</title>
    <style>
        /* CSS dari admin_dashboard.php dan user_show.php */
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

        .list-group-item:hover, .list-group-item.active {
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
            margin-bottom: 20px;
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

        /* Card Custom (tidak digunakan di user_show, tapi tetap disertakan untuk konsistensi) */
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

        /* Specific styles for user table */
        h2 {
            text-align: center;
            color: #ffe96a;
            text-shadow: 0 0 4px #ffef9d;
            margin-bottom: 20px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 90%; /* Lebar tabel disesuaikan */
            background: linear-gradient(135deg, #1a1446, #2c1e77, #431b9a);
            box-shadow: 0 0 20px rgba(94, 53, 177, 0.4);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #5e35b1;
            padding: 10px;
            text-align: center;
            color: #ffffff;
        }

        th {
            background-color: #2a1e52;
            color: #ffe96a;
            font-weight: bold;
        }

        td {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .action-links a {
            margin: 0 5px;
            padding: 6px 12px;
            background: linear-gradient(to right, #00c9ff, #92fe9d);
            color: #0f0a24;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block; /* Agar padding dan margin berfungsi */
        }

        .action-links a:hover {
            background: linear-gradient(to right, #92fe9d, #00c9ff);
            color: #ffffff;
            transform: scale(1.05);
        }

        .action-links a.delete {
            background: linear-gradient(to right, #ff4e00, #ff9500);
            color: white;
        }

        .action-links a.delete:hover {
            background: linear-gradient(to right, #ff9500, #ff4e00);
            transform: scale(1.05);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            background: linear-gradient(to right, #5e35b1, #7c4dff);
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-link a:hover {
            background: linear-gradient(to right, #7c4dff, #5e35b1);
            color: #ffe96a;
        }
    </style>
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="text-white text-center py-4 d-flex flex-column align-items-center">
            <img src="img/medu.jpg" width="170" height="120" class="rounded-3 object-fit-cover border border-primary mb-2 glow">
            <h4 class="mb-0">Admin Panel</h4>
        </div>

        <div class="list-group list-group-flush px-2 mt-3">
            <a href="admin_dashboard.php" class="list-group-item list-group-item-action">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a href="user_show.php" class="list-group-item list-group-item-action active">
                <i class="fas fa-users me-2"></i> Kelola User
            </a>
            <a href="produk2.php" class="list-group-item list-group-item-action">
                <i class="fas fa-box me-2"></i> Produk
            </a>
            <a href="transaksi.php" class="list-group-item list-group-item-action">
                <i class="fas fa-receipt me-2"></i> Transaksi
            </a>
            <a href="pelanggan.php" class="list-group-item list-group-item-action">
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
                <h5 class="ms-3 mb-0">Kelola user</h5>
                <div class="ms-auto">
                    <span class="me-3">Halo, <?= $_SESSION['username']; ?></span>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid mt-4">
            <h2>Daftar Pengguna</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['username']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['role']); ?></td>
                    <td class="action-links">
                        <a href="user_edit.php?id=<?= $row['id']; ?>">Edit</a>
                        <a href="user_delete.php?id=<?= $row['id']; ?>" class="delete" onclick="return confirm('Hapus user ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Toggle sidebar
    document.getElementById("menu-toggle").addEventListener("click", function () {
        document.getElementById("wrapper").classList.toggle("toggled");
    });
</script>
</body>
</html>