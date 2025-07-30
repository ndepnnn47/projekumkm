<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kontak Kami - ShopEase</title>
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

    /* Kontak */
    .contact-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      padding: 120px 10% 50px; /* Adjusted padding-top for fixed navbar */
      gap: 40px;
    }

    .contact-info {
      flex: 1;
      min-width: 280px;
    }

    .contact-info h2 {
      color: #ffe76d;
      margin-bottom: 20px;
    }

    .contact-info p {
      line-height: 1.6;
      color: #ccc;
    }

    .contact-info h3 {
      margin-top: 30px;
      color: #fff;
    }

    .contact-form {
      flex: 1;
      min-width: 300px;
    }

    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: none;
      background-color: #1e1640;
      color: #fff;
      border-radius: 5px;
    }

    .contact-form input::placeholder,
    .contact-form textarea::placeholder {
      color: #aaa;
    }

    .contact-form button {
      background-color: #ffe76d;
      color: #0f0a24;
      font-weight: bold;
      padding: 12px 30px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      transition: 0.3s;
    }

    .contact-form button:hover {
      background-color: #fff199;
    }

    @media screen and (max-width: 768px) {
      /* No need for nav ul display: none; as Tailwind handles mobile menu */
      .contact-container {
        flex-direction: column;
        padding: 120px 5% 50px;
      }
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
                  <a href="index.php" class="text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300 font-medium">Beranda</a>
                  <a href="produk.php" class="text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300 font-medium">Produk</a>
                  <a href="index.php#kategori" class="text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300 font-medium">Kategori</a>
                  <a href="index.php#tentang" class="text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300 font-medium">Tentang</a>
                  <a href="kontak.php" class="text-[#ffe76d] hover:text-[#00e5ff] transition duration-300 font-medium">Kontak</a>
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
                  <a href="login.php" class="p-2 text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300">
                      <i class="fas fa-user-circle text-xl"></i>
                  </a>
                  <button class="md:hidden p-2 text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300" id="menu-btn">
                      <i class="fas fa-bars text-xl"></i>
                  </button>
              </div>
          </div>
      </div>
  </nav>

  <!-- Konten Kontak -->
  <div class="contact-container">
    <div class="contact-info">
      <h2>Contact Us</h2>
      <p>As you might expect of a company that began as a high-end interiors contractor, we pay strict attention.</p>

      <h3>America</h3>
      <p>195 E Parker Square Dr, Parker, CO 801<br>+43 982-314-0958</p>

      <h3>France</h3>
      <p>109 Avenue Léon, 63 Clermont-Ferrand<br>+12 345-423-9893</p>
    </div>

    <div class="contact-form">
      <form action="kontak_kirim.php" method="POST">
        <input type="text" name="nama" placeholder="Name" required />
        <input type="email" name="email" placeholder="Email" required />
        <textarea name="pesan" rows="6" placeholder="Message" required></textarea>
        <button type="submit">SEND MESSAGE</button>
      </form>
    </div>
  </div>

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

<!-- Overlay -->
<div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-70 z-10"></div>

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
                    <li><a href="index.php" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Beranda</a></li>
                    <li><a href="produk.php" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Produk</a></li>
                    <li><a href="index.php#tentang" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Tentang Kami</a></li>
                    <li><a href="kontak.php" class="text-[#e2dbff] hover:text-[#00e5ff] transition duration-300">Kontak</a></li>
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
            <h3 class="text-lg font-semibold mb-4 text    -[#ffe76d]">Kontak Kami</h3>
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

<script>
    // Mobile menu toggle
    document.getElementById('menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden'); // Assuming a mobile menu element exists
    });

    // Cart functionality (copied from index.php)
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
    
    let cart = JSON.parse(localStorage.getItem('cart')) || []; // Load cart from localStorage

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

    overlay.addEventListener('click', () => {
        cartDrawer.classList.remove('active');
        // authModal.classList.remove('active'); // Assuming authModal is not present here
        overlay.classList.add('hidden');
        document.body.style.overflow = ''; // Restore body scroll
    });

    // Update cart display
    function updateCart() {
        // Update cart count
        const totalItems = cart.reduce((sum, item) => sum + item.jumlah, 0); // Changed item.quantity to item.jumlah
        cartCount.textContent = totalItems;
        
        // Update cart items
        if (cart.length === 0) {
            emptyCartMessage.classList.remove('hidden');
            cartSummary.classList.add('hidden');
            cartItemsContainer.innerHTML = '';
        } else {
            emptyCartMessage.classList.add('hidden');
            
            // Calculate subtotal
            const subtotal = cart.reduce((sum, item) => sum + (item.harga * item.jumlah), 0); // Changed item.quantity to item.jumlah
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
                        <img src="https://via.placeholder.com/100x100/431b9a/ffffff?text=Produk" alt="${item.nama}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-grow">
                        <h4 class="font-medium text-[#ffe76d]">${item.nama}</h4>
                        <div class="flex justify-between items-center mt-1">
                            <div class="flex items-center border border-[#00e5ff] rounded-lg text-[#e2dbff]">
                                <button class="decrease-qty px-2 py-1 hover:bg-[#431b9a] transition duration-200" data-id="${item.id}">-</button>
                                <span class="px-2">${item.jumlah}</span>
                                <button class="increase-qty px-2 py-1 hover:bg-[#431b9a] transition duration-200" data-id="${item.id}">+</button>
                            </div>
                            <span class="text-[#92fe9d] font-bold">${formatCurrency(item.harga)}</span>
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
                        item.jumlah++;
                        updateCart();
                    }
                });
            });

            cartItemsContainer.querySelectorAll('.decrease-qty').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const item = cart.find(i => i.id === id);
                    if (item && item.jumlah > 1) {
                        item.jumlah--;
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