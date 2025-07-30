<?php
session_start(); // Pastikan session_start() ada di awal file
include "koneksi.php"; // Pastikan koneksi.php sudah di-include

// Ambil data produk dari database (jika ada, ini dari konteks produk.php)
// Jika tidak ada produk di index.php, bagian ini bisa diabaikan atau disesuaikan
// $result = $conn->query("SELECT * FROM tb_produk"); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEase - Belanja Online Mudah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Georgia&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #0f0a24; /* Warna latar belakang dari register.php */
            color: #e2dbff; /* Warna teks umum agar terlihat */
        }
        .cart-drawer {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        .cart-drawer.active {
            transform: translateX(0);
        }
        .modal {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        .modal.active {
            opacity: 1;
            visibility: visible;
        }
        .product-card:hover .product-overlay {
            opacity: 1;
        }
        /* Custom scrollbar for dark theme */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1a1446;
        }
        ::-webkit-scrollbar-thumb {
            background: #431b9a;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #5e35b1;
        }

        html {
            scroll-behavior: smooth;
        }

        /* CSS untuk Profile Drawer */
        .profile-drawer {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        .profile-drawer.active {
            transform: translateX(0);
        }

        /* Custom style for logout button in profile drawer */
        .profile-drawer .logout-btn-profile {
            background: linear-gradient(to right, #ff4e00, #ff9500); /* Red-orange gradient */
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .profile-drawer .logout-btn-profile:hover {
            background: linear-gradient(to right, #ff9500, #ff4e00); /* Reverse gradient on hover */
            transform: scale(1.02);
            box-shadow: 0 0 10px rgba(255, 149, 0, 0.5);
        }
    </style>
</head>
<body class="font-serif">
    <!-- Navbar -->
    <nav class="bg-[#1a1446] shadow-lg fixed w-full z-10 border-b-2 border-[#5e35b1]">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="img/logo.jpg" alt="Logo ShopEase" class="h-10 mr-2 rounded-full border border-[#00e5ff]">
                    <span class="text-2xl font-bold text-[#ffe76d] drop-shadow-md">Médubleu</span>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300 font-medium">Beranda</a>
                    <a href="produk.php">Produk</a>
                    <a href="#kategori">Kategori</a>
                    <a href="#tentang">Tentang</a>
                    <a href="kontak.php">Kontak</a>
                </div>

                <!-- Search and Icons -->
                <div class="flex items-center space-x-4">
                    <div class="hidden md:block relative">
                        <input type="text" placeholder="Cari produk..." class="border border-[#00e5ff] rounded-full py-2 px-4 pl-10 w-64 bg-[#150c34] text-[#ffffff] placeholder-[#c7bfff] focus:outline-none focus:ring-2 focus:ring-[#00e5ff]">
                        <i class="fas fa-search absolute left-3 top-3 text-[#e0d3ff]"></i>
                    </div>
                    <button id="cart-btn" class="relative p-2 text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span id="cart-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-sans">0</span>
                    </button>
                    <!-- Tombol Profile/Login -->
                    <button id="profile-btn" class="p-2 text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300">
                        <i class="fas fa-user-circle text-xl"></i>
                    </button>
                    <button class="md:hidden p-2 text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300" id="menu-btn">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-16 bg-gradient-to-r from-[#431b9a] to-[#2c1e77] text-white">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#ffe76d] drop-shadow-lg">Belanja Online Lebih Mudah & Praktis</h1>
                <p class="text-lg mb-6 text-[#e2dbff]">Temukan ribuan produk berkualitas dengan harga terbaik hanya di ShopEase. Gratis ongkir untuk pesanan pertama!</p>
                <div class="flex space-x-4">
                    <button onclick="window.location.href='produk.php';" class="bg-gradient-to-r from-[#00c9ff] to-[#92fe9d] text-[#0f0a24] font-bold py-2 px-6 rounded-full hover:from-[#92fe9d] hover:to-[#00c9ff] hover:text-white transition duration-300 shadow-lg">
                        Belanja Sekarang
                    </button>
                </div>
            </div>
            <div class="md:w-1/2">
                <img src="img/baju.jpg" alt="Ilustrasi proses pembuatan produk dengan tangan" class="rounded-full shadow-xl border-2 border-[#5e35b1]">
            </div>
        </div>
    </section>

    <!-- Category Section -->
    <section id="kategori" class="py-12 bg-[#1a1446]">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-8 text-[#ffe76d]">Kategori Populer</h2>
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4">
                <div class="bg-[#2c1e77] rounded-lg p-4 text-center hover:shadow-xl transition duration-300 cursor-pointer border border-[#5e35b1]">
                    <div class="bg-[#431b9a] rounded-full p-3 w-16 h-16 mx-auto flex items-center justify-center mb-2 shadow-md">
                        <i class="fas fa-tshirt text-[#92fe9d] text-2xl"></i>
                    </div>
                    <span class="font-medium text-[#e0d3ff]">Pakaian</span>
                </div>
                <div class="bg-[#2c1e77] rounded-lg p-4 text-center hover:shadow-xl transition duration-300 cursor-pointer border border-[#5e35b1]">
                    <div class="bg-[#431b9a] rounded-full p-3 w-16 h-16 mx-auto flex items-center justify-center mb-2 shadow-md">
                        <i class="fas fa-gem text-[#92fe9d] text-2xl"></i>
                    </div>
                    <span class="font-medium text-[#e0d3ff]">Aksesoris</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-12 bg-[#0f0a24]">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-[#ffe76d]">Produk Terbaru</h2>
                <a href="#" class="text-[#00e5ff] hover:underline font-medium">Lihat Semua</a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Product 1 -->
                <div class="bg-[#1a1446] rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300 border border-[#5e35b1]">
                    <div class="relative overflow-hidden h-48">
                        <img src="https://via.placeholder.com/300x300/431b9a/ffffff?text=Smartphone" alt="Smartphone terbaru dengan layar lebar dan kamera canggih" class="w-full h-full object-cover">
                        <div class="product-overlay absolute inset-0 bg-black bg-opacity-50 opacity-0 flex items-center justify-center space-x-4 transition duration-300">
                            <button class="bg-[#00e5ff] text-[#0f0a24] rounded-full p-2 hover:bg-[#92fe9d] hover:text-[#0f0a24] transition duration-300">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="bg-[#00e5ff] text-[#0f0a24] rounded-full p-2 hover:bg-[#92fe9d] hover:text-[#0f0a24] transition duration-300">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="absolute top-2 right-2">
                            <span class="bg-red-600 text-white text-xs font-semibold px-2 py-1 rounded">New</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-1 text-[#ffe76d]">Smartphone Flagship</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-[#e2dbff] text-xs ml-1">(48)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-[#92fe9d]">Rp8.999.000</span>
                            <button class="add-to-cart bg-gradient-to-r from-[#00c9ff] to-[#92fe9d] text-[#0f0a24] rounded-full p-2 hover:from-[#92fe9d] hover:to-[#00c9ff] hover:text-white transition duration-300" data-id="1" data-name="Smartphone Flagship" data-price="8999000">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-[#1a1446] rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300 border border-[#5e35b1]">
                    <div class="relative overflow-hidden h-48">
                        <img src="https://via.placeholder.com/300x300/2c1e77/ffffff?text=Headphone" alt="Headphone nirkabel premium dengan fitur noise cancellation" class="w-full h-full object-cover">
                        <div class="product-overlay absolute inset-0 bg-black bg-opacity-50 opacity-0 flex items-center justify-center space-x-4 transition duration-300">
                            <button class="bg-[#00e5ff] text-[#0f0a24] rounded-full p-2 hover:bg-[#92fe9d] hover:text-[#0f0a24] transition duration-300">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="bg-[#00e5ff] text-[#0f0a24] rounded-full p-2 hover:bg-[#92fe9d] hover:text-[#0f0a24] transition duration-300">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-1 text-[#ffe76d]">Headphone Wireless</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-[#e2dbff] text-xs ml-1">(112)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-[#92fe9d]">Rp1.499.000</span>
                            <button class="add-to-cart bg-gradient-to-r from-[#00c9ff] to-[#92fe9d] text-[#0f0a24] rounded-full p-2 hover:from-[#92fe9d] hover:to-[#00c9ff] hover:text-white transition duration-300" data-id="2" data-name="Headphone Wireless" data-price="1499000">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="bg-[#1a1446] rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300 border border-[#5e35b1]">
                    <div class="relative overflow-hidden h-48">
                        <img src="https://via.placeholder.com/300x300/1a1446/ffffff?text=Smartwatch" alt="Jam tangan digital canggih dengan berbagai fitur kesehatan" class="w-full h-full object-cover">
                        <div class="product-overlay absolute inset-0 bg-black bg-opacity-50 opacity-0 flex items-center justify-center space-x-4 transition duration-300">
                            <button class="bg-[#00e5ff] text-[#0f0a24] rounded-full p-2 hover:bg-[#92fe9d] hover:text-[#0f0a24] transition duration-300">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="bg-[#00e5ff] text-[#0f0a24] rounded-full p-2 hover:bg-[#92fe9d] hover:text-[#0f0a24] transition duration-300">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-1 text-[#ffe76d]">Smartwatch Pro</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-[#e2dbff] text-xs ml-1">(89)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-[#92fe9d]">Rp3.199.000</span>
                                <span class="block text-sm text-[#e2dbff] line-through">Rp3.999.000</span>
                            </div>
                            <button class="add-to-cart bg-gradient-to-r from-[#00c9ff] to-[#92fe9d] text-[#0f0a24] rounded-full p-2 hover:from-[#92fe9d] hover:to-[#00c9ff] hover:text-white transition duration-300" data-id="3" data-name="Smartwatch Pro" data-price="3199000">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="bg-[#1a1446] rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300 border border-[#5e35b1]">
                    <div class="relative overflow-hidden h-48">
                        <img src="https://via.placeholder.com/300x300/7c4dff/ffffff?text=Camera" alt="Kamera mirrorless profesional dengan lensa kit" class="w-full h-full object-cover">
                        <div class="product-overlay absolute inset-0 bg-black bg-opacity-50 opacity-0 flex items-center justify-center space-x-4 transition duration-300">
                            <button class="bg-[#00e5ff] text-[#0f0a24] rounded-full p-2 hover:bg-[#92fe9d] hover:text-[#0f0a24] transition duration-300">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="bg-[#00e5ff] text-[#0f0a24] rounded-full p-2 hover:bg-[#92fe9d] hover:text-[#0f0a24] transition duration-300">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-1 text-[#ffe76d]">Kamera Mirrorless</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-[#e2dbff] text-xs ml-1">(76)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-[#92fe9d]">Rp12.499.000</span>
                            <button class="add-to-cart bg-gradient-to-r from-[#00c9ff] to-[#92fe9d] text-[#0f0a24] rounded-full p-2 hover:from-[#92fe9d] hover:to-[#00c9ff] hover:text-white transition duration-300" data-id="4" data-name="Kamera Mirrorless" data-price="12499000">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Storytelling Produk Section -->
    <section id="tentang" class="py-12 bg-[#1a1446]">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-8 text-[#ffe76d]">Kisah di Balik Produk Kami</h2>
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-1/2">
                    <img src="img/tentang.jpg" alt="Ilustrasi proses pembuatan produk dengan tangan" class="rounded-full shadow-xl border-2 border-[#5e35b1]">
                </div>
                <div class="md:w-1/2 text-center md:text-left">
                    <p class="text-lg mb-4 text-[#e2dbff]">Setiap produk di ShopEase dipilih dengan cermat dan dibuat dengan dedikasi. Kami percaya bahwa kualitas adalah kunci, dan setiap detail diperhitungkan untuk memberikan pengalaman terbaik bagi Anda.</p>
                    <p class="text-lg mb-4 text-[#e2dbff]">Dari bahan baku pilihan hingga proses produksi yang teliti, kami memastikan bahwa Anda mendapatkan produk yang tidak hanya indah, tetapi juga tahan lama dan fungsional.</p>
                    <p class="text-lg text-[#e2dbff]">Kami berkolaborasi dengan pengrajin lokal dan merek terkemuka untuk menghadirkan koleksi yang unik dan berkualitas tinggi, mendukung ekonomi kreatif dan keberlanjutan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Model Photos Section -->
    <section class="py-12 bg-[#0f0a24]">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-8 text-[#ffe76d]">Inspirasi Gaya Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-[#1a1446] rounded-lg overflow-hidden shadow-md border border-[#5e35b1]">
                    <img src="img/model1.jpg" alt="Model mengenakan pakaian gaya urban chic" class="w-full aspect-[4/5] object-cover rounded-t-lg">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-[#ffe76d]">Gaya Urban Chic</h3>
                        <p class="text-[#e2dbff]">Tampil stylish dan modern di tengah hiruk pikuk kota.</p>
                    </div>
                </div>
                <div class="bg-[#1a1446] rounded-lg overflow-hidden shadow-md border border-[#5e35b1]">
                    <img src="img/model3.jpg" alt="Model mengenakan pakaian gaya urban chic" class="w-full aspect-[4/5] object-cover rounded-t-lg">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-[#ffe76d]">Elegan & Modern</h3>
                        <p class="text-[#e2dbff]">Paduan sempurna antara kemewahan dan kesederhanaan.</p>
                    </div>
                </div>
                <div class="bg-[#1a1446] rounded-lg overflow-hidden shadow-md border border-[#5e35b1]">
                    <img src="img/model2.jpg" alt="Model mengenakan pakaian gaya urban chic" class="w-full aspect-[4/5] object-cover rounded-t-lg">
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold text-[#ffe76d]">Kasual Santai</h3>
                        <p class="text-[#e2dbff]">Nyaman dan tetap trendi untuk aktivitas sehari-hari.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-12 bg-[#1a1446]">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="flex flex-col items-center text-center p-6 bg-[#2c1e77] rounded-lg shadow-md border border-[#5e35b1]">
                    <div class="bg-[#431b9a] rounded-full p-4 mb-4 shadow-md">
                        <i class="fas fa-truck text-[#92fe9d] text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#ffe76d]">Gratis Ongkir</h3>
                    <p class="text-[#e2dbff]">Gratis ongkos kirim untuk pesanan pertama dan minimal pembelian Rp200.000</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 bg-[#2c1e77] rounded-lg shadow-md border border-[#5e35b1]">
                    <div class="bg-[#431b9a] rounded-full p-4 mb-4 shadow-md">
                        <i class="fas fa-shield-alt text-[#92fe9d] text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#ffe76d]">Garansi Produk</h3>
                    <p class="text-[#e2dbff]">Semua produk kami bergaransi resmi 1 tahun dan original 100%</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 bg-[#2c1e77] rounded-lg shadow-md border border-[#5e35b1]">
                    <div class="bg-[#431b9a] rounded-full p-4 mb-4 shadow-md">
                        <i class="fas fa-headset text-[#92fe9d] text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#ffe76d]">Bantuan 24/7</h3>
                    <p class="text-[#e2dbff]">Customer service kami siap membantu Anda kapan saja</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-12 bg-[#0f0a24]">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-2 text-[#ffe76d]">Berlangganan Newsletter</h2>
            <p class="text-[#e2dbff] max-w-2xl mx-auto mb-6">Dapatkan informasi promo dan diskon spesial langsung ke email Anda</p>
            <div class="flex max-w-md mx-auto">
                <input type="email" placeholder="Alamat email Anda" class="flex-grow px-4 py-2 rounded-l-full focus:outline-none focus:ring-2 focus:ring-[#00e5ff] bg-[#150c34] text-[#ffffff] placeholder-[#c7bfff] border border-[#00e5ff]">
                <button class="bg-gradient-to-r from-[#00c9ff] to-[#92fe9d] text-[#0f0a24] px-6 py-2 rounded-r-full hover:from-[#92fe9d] hover:to-[#00c9ff] hover:text-white transition duration-300 font-bold">Berlangganan</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#1a1446] text-[#e2dbff] pt-12 pb-6 border-t-2 border-[#5e35b1]">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4 flex items-center text-[#ffe76d]">
                        <img src="img/logo.jpg" alt="Logo kecil ShopEase" class="h-6 mr-2 rounded-full border border-[#00e5ff]">
                       Médubleu
                    </h3>
                    <p class="text-[#e2dbff]">Platform belanja online terpercaya dengan ribuan produk berkualitas dan harga terjangkau.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-[#ffe76d]">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Beranda</a></li>
                        <li><a href="#" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Produk</a></li>
                        <li><a href="#" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Tentang Kami</a></li>
                        <li><a href="#" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Kontak</a></li>
                        <li><a href="#" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-[#ffe76d]">Kategori</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Elektronik</a></li>
                        <li><a href="#" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Fashion</a></li>
                        <li><a href="#" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Kesehatan</a></li>
                        <li><a href="#" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Rumah Tangga</a></li>
                        <li><a href="#" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Olahraga</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-[#ffe76d]">Kontak Kami</h3>
                    <ul class="space-y-2 text-[#e2dbff]">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-[#00e5ff]"></i>
                            <span>Jl. Contoh No. 123, Cirebon</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2 text-[#00e5ff]"></i>
                            <a href="https://wa.me/6287822183132" target="_blank" class="hover:underline">
                                +62 878-2218-3132
                            </a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-[#00e5ff]"></i>
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=medubleu.business@gmail.com" target="_blank" class="hover:underline">
                                medubleu.business@gmail.com
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-[#5e35b1] pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-[#e2dbff] mb-4 md:mb-0">&copy; 2023 ShopEase. All rights reserved.</p>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/share/14F4U3CM7PG/?mibextid=qi2Omg" target="_blank" rel="noopener noreferrer" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.tiktok.com/@medu_bleu?_t=ZS-8yPFGhLrlEV&_r=1" target="_blank" rel="noopener noreferrer" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="https://www.instagram.com/medubleu?igsh=cmk0ZWFoa2ZjMm12" target="_blank" rel="noopener noreferrer" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/6287822183132" target="_blank" rel="noopener noreferrer" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cart Drawer -->
    <div id="cart-drawer" class="cart-drawer fixed top-0 right-0 w-full sm:w-96 h-full bg-[#1a1446] shadow-xl z-20 overflow-y-auto border-l-2 border-[#5e35b1] text-[#e2dbff]">
        <div class="p-4">
            <div class="flex justify-between items-center border-b border-[#5e35b1] pb-4">
                <h3 class="text-xl font-semibold text-[#ffe76d]">Keranjang Belanja</h3>
                <button id="close-cart" class="text-[#e2dbff] hover:text-[#00e5ff]">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="cart-items" class="py-4">
                <!-- Cart items will be added here dynamically -->
                <div class="text-center py-8" id="empty-cart-message">
                    <i class="fas fa-shopping-cart text-4xl text-[#5e35b1] mb-2"></i>
                    <p class="text-[#e2dbff]">Keranjang belanja Anda kosong</p>
                </div>
            </div>
            <div class="border-t border-[#5e35b1] pt-4 hidden" id="cart-summary">
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span id="cart-subtotal">Rp0</span>
                </div>
                <div class="flex justify-between mb-4">
                    <span>Ongkos Kirim</span>
                    <span class="text-[#92fe9d]" id="cart-shipping">Gratis</span>
                </div>
                <div class="flex justify-between font-bold text-lg text-[#ffe76d]">
                    <span>Total</span>
                    <span id="cart-total">Rp0</span>
                </div>
                <button class="w-full bg-gradient-to-r from-[#00c9ff] to-[#92fe9d] text-[#0f0a24] py-2 rounded-lg mt-4 hover:from-[#92fe9d] hover:to-[#00c9ff] hover:text-white transition duration-300 font-bold">Lanjut ke Pembayaran</button>
            </div>
        </div>
    </div>

    <!-- Profile Drawer -->
    <div id="profile-drawer" class="profile-drawer fixed top-0 right-0 w-full sm:w-96 h-full bg-[#1a1446] shadow-xl z-20 overflow-y-auto border-l-2 border-[#5e35b1] text-[#e2dbff]">
        <div class="p-4">
            <div class="flex justify-between items-center border-b border-[#5e35b1] pb-4">
                <h3 class="text-xl font-semibold text-[#ffe76d]">Profil Pengguna</h3>
                <button id="close-profile" class="text-[#e2dbff] hover:text-[#00e5ff]">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="py-4">
                <?php if (isset($_SESSION['username']) && $_SESSION['role'] != 'admin'): // TAMBAHKAN KONDISI ROLE TIDAK ADMIN ?>
                    <div class="text-center mb-6">
                        <i class="fas fa-user-circle text-6xl text-[#92fe9d] mb-4"></i>
                        <h4 class="text-2xl font-bold text-[#ffe76d]"><?= htmlspecialchars($_SESSION['username']); ?></h4>
                        <p class="text-md text-[#e0d3ff]"><?= htmlspecialchars($_SESSION['email'] ?? 'Email tidak tersedia'); ?></p>
                        <p class="text-sm text-[#c7bfff]">Role: <?= htmlspecialchars($_SESSION['role'] ?? 'User'); ?></p>
                    </div>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex items-center p-3 rounded-lg bg-[#2c1e77] hover:bg-[#431b9a] transition duration-300">
                                <i class="fas fa-shopping-bag mr-3 text-[#00e5ff]"></i>
                                <span>Pesanan Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="login.php" class="flex items-center p-3 rounded-lg bg-[#2c1e77] hover:bg-[#431b9a] transition duration-300">
                                <i class="fas fa-cog mr-3 text-[#00e5ff]"></i>
                                <span>Ganti Akun</span>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                        <li>
                            <a href="admin_dashboard.php" class="flex items-center p-3 rounded-lg bg-[#2c1e77] hover:bg-[#431b9a] transition duration-300">
                                <i class="fas fa-tachometer-alt mr-3 text-[#00e5ff]"></i>
                                <span>Dashboard Admin</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="logout.php" class="flex items-center p-3 rounded-lg logout-btn-profile">
                                <i class="fas fa-sign-out-alt mr-3 text-white"></i>
                                <span class="text-white">Logout</span>
                            </a>
                        </li>
                    </ul>
                <?php else: ?>
                    <div class="text-center py-8">
                        <i class="fas fa-user-circle text-6xl text-[#5e35b1] mb-4"></i>
                        <p class="text-[#e2dbff] mb-6">Anda belum login.</p>
                        <a href="login.php" class="w-full bg-gradient-to-r from-[#00c9ff] to-[#92fe9d] text-[#0f0a24] py-2 px-6 rounded-lg hover:from-[#92fe9d] hover:to-[#00c9ff] hover:text-white transition duration-300 font-bold">
                            Login Sekarang
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-70 z-10"></div>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Cart functionality
        const cartBtn = document.getElementById('cart-btn');
        const closeCart = document.getElementById('close-cart');
        const cartDrawer = document.getElementById('cart-drawer');
        const cartItemsContainer = document.getElementById('cart-items');
        const cartCount = document.getElementById('cart-count');
        const emptyCartMessage = document.getElementById('empty-cart-message');
        const cartSummary = document.getElementById('cart-summary');
        const cartSubtotal = document.getElementById('cart-subtotal');
        const cartTotal = document.getElementById('cart-total');
        const overlay = document.getElementById('overlay');
        
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Function to format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        // Toggle cart drawer
        cartBtn.addEventListener('click', () => {
            cartDrawer.classList.add('active');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent body scroll
        });

        closeCart.addEventListener('click', () => {
            cartDrawer.classList.remove('active');
            overlay.classList.add('hidden');
            document.body.style.overflow = ''; // Restore body scroll
        });

        // Profile functionality
        const profileBtn = document.getElementById('profile-btn');
        const closeProfile = document.getElementById('close-profile');
        const profileDrawer = document.getElementById('profile-drawer');

        profileBtn.addEventListener('click', () => {
            profileDrawer.classList.add('active');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent body scroll
        });

        closeProfile.addEventListener('click', () => {
            profileDrawer.classList.remove('active');
            overlay.classList.add('hidden');
            document.body.style.overflow = ''; // Restore body scroll
        });

        overlay.addEventListener('click', () => {
            cartDrawer.classList.remove('active');
            profileDrawer.classList.remove('active'); // Close profile drawer too
            overlay.classList.add('hidden');
            document.body.style.overflow = ''; // Restore body scroll
        });

        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = parseInt(this.dataset.price);
                
                const existingItem = cart.find(item => item.id === id);
                
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push({
                        id,
                        name,
                        price,
                        quantity: 1
                    });
                }
                
                updateCart();
            });
        });

        // Update cart display
        function updateCart() {
            // Update cart count
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems;
            
            // Update cart items
            if (cart.length === 0) {
                emptyCartMessage.classList.remove('hidden');
                cartSummary.classList.add('hidden');
                cartItemsContainer.innerHTML = '';
            } else {
                emptyCartMessage.classList.add('hidden');
                
                // Calculate subtotal
                const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                cartSubtotal.textContent = formatCurrency(subtotal);
                cartTotal.textContent = formatCurrency(subtotal); // Assuming shipping is free for now
                cartSummary.classList.remove('hidden');
                
                // Render cart items
                cartItemsContainer.innerHTML = '';
                cart.forEach(item => {
                    const cartItemElement = document.createElement('div');
                    cartItemElement.className = 'flex items-center py-4 border-b border-[#5e35b1]';
                    cartItemElement.innerHTML = `
                        <div class="w-16 h-16 bg-[#2c1e77] rounded-lg mr-4 overflow-hidden flex-shrink-0">
                            <img src="https://via.placeholder.com/100x100/431b9a/ffffff?text=Produk" alt="${item.name}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-medium text-[#ffe76d]">${item.name}</h4>
                            <div class="flex justify-between items-center mt-1">
                                <div class="flex items-center border border-[#00e5ff] rounded-lg text-[#e2dbff]">
                                    <button class="decrease-qty px-2 py-1 hover:bg-[#431b9a] transition duration-200" data-id="${item.id}">-</button>
                                    <span class="px-2">${item.quantity}</span>
                                    <button class="increase-qty px-2 py-1 hover:bg-[#431b9a] transition duration-200" data-id="${item.id}">+</button>
                                </div>
                                <span class="text-[#92fe9d] font-bold">${formatCurrency(item.price)}</span>
                            </div>
                        </div>
                        <button class="remove-item ml-4 text-red-400 hover:text-red-600 transition duration-300" data-id="${item.id}">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    cartItemsContainer.appendChild(cartItemElement);
                });

                // Add event listeners for quantity change and remove
                cartItemsContainer.querySelectorAll('.increase-qty').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        const item = cart.find(i => i.id === id);
                        if (item) {
                            item.quantity++;
                            updateCart();
                        }
                    });
                });

                cartItemsContainer.querySelectorAll('.decrease-qty').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        const item = cart.find(i => i.id === id);
                        if (item && item.quantity > 1) {
                            item.quantity--;
                            updateCart();
                        }
                    });
                });

                cartItemsContainer.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        cart = cart.filter(item => item.id !== id);
                        updateCart();
                    });
                });
            }
        }

        // Initial cart update
        updateCart();
    </script>
</body>
</html>