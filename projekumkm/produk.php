<?php
session_start();
include "koneksi.php";

// Ambil data produk dari database
$result = $conn->query("SELECT * FROM tb_produk");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
  </style>
</head>
<body class="bg-[#1a1446] text-white font-serif">

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
                <a href="produk.php" class="text-[#ffe76d] hover:text-[#00e5ff] transition duration-300 font-medium">Produk</a>
                <a href="index.php#kategori" class="text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300 font-medium">Kategori</a>
                <a href="index.php#tentang" class="text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300 font-medium">Tentang</a>
                <a href="kontak.php" class="text-[#e0d3ff] hover:text-[#00e5ff] transition duration-300 font-medium">Kontak</a>
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

<!-- Judul Halaman Produk -->
<header class="text-center pt-28 pb-6">
  <h1 class="text-5xl font-extrabold text-yellow-300 drop-shadow-lg tracking-wide">
    Daftar Produk
  </h1>
</header>

<!-- Daftar Produk -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-6 pb-16">
  <?php while ($row = $result->fetch_assoc()) : ?>
    <div class="bg-[#2a1d64] rounded-2xl p-4 shadow-lg hover:shadow-xl transition duration-300">
      <img src="img/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>" class="w-full h-48 object-cover rounded-xl mb-4">
      <h2 class="text-xl font-semibold text-white mb-2"><?= $row['nama']; ?></h2>
      <p class="text-[#92fe9d] font-bold mb-2">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></p>
      <button 
        onclick="tambahKeKeranjang('<?= $row['id']; ?>', '<?= $row['nama']; ?>', <?= $row['harga']; ?>)"
        class="w-full py-2 bg-gradient-to-r from-[#00c9ff] to-[#92fe9d] text-[#0f0a24] font-bold rounded-full hover:from-[#92fe9d] hover:to-[#00c9ff] hover:text-white transition duration-300 shadow-md">
        <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
      </button>
    </div>
  <?php endwhile; ?>
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

<!-- Script Keranjang -->
<script>
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  function tambahKeKeranjang(id, nama, harga) {
    const index = cart.findIndex(item => item.id == id);
    if (index !== -1) {
      cart[index].jumlah += 1;
    } else {
      cart.push({ id, nama, harga, jumlah: 1 });
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    alert(nama + " ditambahkan ke keranjang!");
    updateCart(); // Update cart display after adding item
  }

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