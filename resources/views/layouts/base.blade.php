<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ARSIP - SISMAF</title>

  <!-- Fonts & Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
 <!-- DataTables v1.13.7 CSS -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />


  <!-- Custom Style -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script
			  src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
			  integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
			  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .wrapper {
      display: flex;
    }

    #sidebar {
      width: 250px;
      background-color: #2c3e50;
      color: #fff;
      padding: 20px 10px;
      box-sizing: border-box;
      overflow-y: auto;
    }

    .content-area {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .main-content {
      flex: 1;
      padding: 20px;
      background-color: #f9f9f9;
      overflow-y: auto;
      display: none; /* disembunyikan saat loader aktif */
    }

    .footer-global {
      background-color: #fff;
      padding: 15px;
      text-align: center;
      color: #666;
      box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.05);
    }

    .dropdown.active {
      display: block;
    }

    .dropdown {
      display: none;
      list-style-type: none;
      padding-left: 20px;
      transition: all 0.3s ease;
    }

    .dropdown li a {
      color: #333;
      text-decoration: none;
      padding: 5px 10px;
      display: block;
      transition: background-color 0.3s;
    }

    .dropdown li a:hover {
      background-color: #f0f0f0;
      color: #000;
    }

    .active-menu {
      color: #007bff;
    }

    .active-menu + .dropdown li a {
      background-color: #d9d9d9;
    }

    /* Loader style */
    #loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    .spinner {
      width: 50px;
      height: 50px;
      border: 5px solid #ccc;
      border-top-color: #3498db;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
</head>
<body>

  <!-- Loader -->
  <div id="loader">
    <div class="spinner"></div>
  </div>

  <div class="wrapper">
    <!-- Sidebar -->
    <div id="sidebar">
      <div class="imgcontainer">
        <img src="{{ asset('images/mweb2.png') }}" alt="mweb2" style="max-width: 100%;">
      </div>
      <ul>
        <li><a href="{{route('dash')}}"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="#"><i class="fas fa-chart-line"></i> Dashboard</a></li>
        <li id="admin-menu"><a href="admin.html"><i class="fas fa-user-shield"></i> Approve Peminjaman</a></li>
        <li class="menu-item">
          <a href="#"><i class="fas fa-user"></i> Manajemen Nasabah Aktif <i class="fas fa-chevron-down" style="margin-left: 2rem;"></i></a>
          <ul class="dropdown">
            <li><a href="{{route('NasabahAktif')}}" class="sidebar-btn"><i class="fas fa-plus-circle"></i> Input Dokumen</a></li>
          </ul>
        </li>
        <li class="menu-item">
          <a href="#"><i class="fas fa-check-circle"></i> Manajemen Nasabah Lunas <i class="fas fa-chevron-down" style="margin-left: 2rem;"></i></a>
          <ul class="dropdown">
            <li><a><i class="fas fa-plus-circle"></i> Input Dokumen</a></li>
          </ul>
        </li>
        <li class="menu-item">
          <a href="#"><i class="fas fa-trash"></i> Manajemen Pemusnahan <i class="fas fa-chevron-down" style="margin-left: 2rem;"></i></a>
          <ul class="dropdown">
            <li><a><i class="fas fa-plus-circle"></i> Input Dokumen</a></li>
          </ul>
        </li>
        <li class="menu-item">
          <a href="#"><i class="fas fa-folder-open"></i> Pinjam Dokumen <i class="fas fa-chevron-down" style="margin-left: 2rem;"></i></a>
          <ul class="dropdown">
            <li><a><i class="fas fa-plus-circle"></i> Input Pinjam Dokumen</a></li>
          </ul>
        </li>
        <li><a href="#" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div>

    <!-- Main Content Area -->
    <div class="content-area">
      <!-- Top Bar -->
      <div class="top-bar" style="background-color: #ffffff; padding: 15px 25px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <div style="color: #333; font-weight: 500; font-size: 14px;">
            <span id="current-date"></span> | <span id="current-time"></span> WIB
          </div>
          <div style="display: flex; align-items: center; gap: 20px;">
            <a href="#" title="Mailbox"><i class="fas fa-envelope fa-lg" style="color: #333;"></i></a>
            <div class="profile" style="display: flex; align-items: center; gap: 10px;">
              <img src="{{ asset('images/profile.png') }}" alt="User" style="width: 35px; height: 35px; border-radius: 50%;">
              <span style="font-weight: 600; color: #333;">{{ Auth::user()->name ?? 'Guest' }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div id="mainContent" class="main-content">
        @yield('konten')
      </div>

      <!-- Footer -->
      <footer class="footer-global">
        <p>2024 &copy; SISMAF</p>
      </footer>
    </div>
  </div>

  <!-- Clock & Loader Logic -->
  <script>
    function updateClockWIB() {
      const now = new Date();
      const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
      const wib = new Date(utc + (7 * 60 * 60 * 1000));

      const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
      const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

      const formattedDate = `${days[wib.getDay()]}, ${wib.getDate()} ${months[wib.getMonth()]} ${wib.getFullYear()}`;
      const formattedTime = `${String(wib.getHours()).padStart(2, '0')}:${String(wib.getMinutes()).padStart(2, '0')}:${String(wib.getSeconds()).padStart(2, '0')}`;

      document.getElementById('current-date').textContent = formattedDate;
      document.getElementById('current-time').textContent = formattedTime;
    }

    document.addEventListener("DOMContentLoaded", () => {
      updateClockWIB();
      setInterval(updateClockWIB, 1000);
    });

    // ✅ Loader hilang setelah semua resource siap
    window.onload = function () {
      document.getElementById("loader").style.display = "none";
      document.getElementById("mainContent").style.display = "block";
    };
  </script>

  <!-- Sidebar Dropdown -->
  <script>
    const menuItems = document.querySelectorAll('.menu-item > a');
    menuItems.forEach(item => {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        const submenu = item.nextElementSibling;
        if (submenu && submenu.classList.contains('dropdown')) {
          submenu.classList.toggle('active');
        }
        item.classList.toggle('active-menu');
      });
    });
  </script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>
</html>
