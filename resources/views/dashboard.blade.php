<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Lembaga Philanthropy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f4f7;
      margin: 0;
      padding: 0;
      display: flex;
    }
    /* sidebar */
    .sidebar {
      width: 240px;
      min-height: 100vh;
      background: #ffffff;
      border-right: 1px solid #e6e6e6;
      padding-top: 1rem;
      position: fixed;
      top: 0;
      left: 0;
    }
    .sidebar .sidebar-brand {
      font-weight: bold;
      font-size: 18px;
      padding: 0 1rem 1rem 1rem;
      border-bottom: 1px solid #eee;
    }
    .sidebar ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }
    .sidebar ul li a {
      display: block;
      padding: .6rem 1rem;
      color: #333;
      text-decoration: none;
    }
    .sidebar ul li a:hover,
    .sidebar ul li a.active {
      background-color: #f0f8ff;
      font-weight: bold;
    }
    .sidebar ul li button {
      width: 100%;
      text-align: left;
      border: none;
      background: none;
      padding: .6rem 1rem;
      color: #333;
      text-decoration: none;
      cursor: pointer;
    }
    .sidebar ul li button:hover {
      background-color: #f0f8ff;
    }
    /* Role badge */
    .role-badge {
      display: inline-block;
      background-color: #007bff;
      color: white;
      font-size: 11px;
      padding: 2px 8px;
      border-radius: 12px;
      margin-left: 8px;
    }
    .role-badge.crm {
      background-color: #28a745;
    }
    .role-badge.keuangan {
      background-color: #ffc107;
      color: #333;
    }
    .role-badge.admin {
      background-color: #dc3545;
    }
    /* content area */
    .dashboard-container {
      flex: 1;
      margin-left: 240px; /* offset sidebar */
      padding: 20px;
    }
    .header {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .header h1 {
      margin: 0;
      color: #333;
      font-size: 24px;
    }
    .user-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .logout-btn {
      background-color: #f9a825;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      font-size: 14px;
    }
    .logout-btn:hover {
      background-color: #f57f17;
    }
    .content {
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
    }
    .content h2 {
      color: #333;
      margin-top: 0;
    }
    .permissions-info {
      background-color: #e7f3ff;
      border: 1px solid #b3d7ff;
      border-radius: 8px;
      padding: 20px;
      margin-top: 20px;
      text-align: left;
    }
    .permissions-info h4 {
      color: #0056b3;
      margin-top: 0;
    }
    .permissions-info ul {
      margin: 10px 0;
      padding-left: 20px;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <nav class="sidebar">
    <div class="sidebar-brand">
      LAZ
      <span class="role-badge {{ strtolower(Auth::user()->role) }}">
        {{ Auth::user()->role }}
      </span>
    </div>
    <ul>
      <li>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <i class="bi bi-speedometer2"></i> Dashboard
        </a>
      </li>
      
      <!-- Menu khusus untuk CRM/Fundraiser -->
      @if(Auth::user()->role === 'crm' || Auth::user()->role === 'crm')
      <li>
        <a href="{{ route('crm.input_cash') }}" class="{{ request()->routeIs('crm.input_cash') ? 'active' : '' }}">
          <i class="bi bi-cash-coin"></i> Input Donasi Cash
        </a>
      </li>
      <li>
        <a href="{{ route('crm.validasi_transfer') }}" class="{{ request()->routeIs('crm.validasi_transfer') ? 'active' : '' }}">
          <i class="bi bi-bank"></i> Validasi Transfer
        </a>
      </li>
      @endif

      <!-- Menu khusus untuk Keuangan -->
      @if(Auth::user()->role === 'Keuangan' || Auth::user()->role === 'keuangan')
      <li>
        <a href="{{ route('keuangan.upload_mutasi') }}" class="{{ request()->routeIs('keuangan.upload_mutasi') ? 'active' : '' }}">
          <i class="bi bi-upload"></i> Upload Mutasi Bank
        </a>
      </li>
      <li>
        <a href="{{ route('keuangan.validasi_mutasi') }}" class="{{ request()->routeIs('keuangan.validasi_mutasi') ? 'active' : '' }}">
          <i class="bi bi-check-circle"></i> Validasi Mutasi
        </a>
      </li>
      <li>
        <a href="{{ route('keuangan.terima_setoran') }}" class="{{ request()->routeIs('keuangan.terima_setoran') ? 'active' : '' }}">
          <i class="bi bi-wallet2"></i> Terima Setoran Cash
        </a>
      </li>
      @endif

      <!-- Menu Laporan untuk semua role -->
      <li>
        <a href="{{ route('keuangan.laporan') }}" class="{{ request()->routeIs('keuangan.laporan') ? 'active' : '' }}">
          <i class="bi bi-clipboard-data"></i> Laporan
        </a>
      </li>
      
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-btn w-100 text-start">
            <i class="bi bi-box-arrow-right"></i> Logout
          </button>
        </form>
      </li>
    </ul>
  </nav>

  <!-- Dashboard content -->
  <div class="dashboard-container">
    <div class="header">
      <h1>Dashboard Lembaga Philanthropy</h1>
      <div class="user-info">
        <span>{{ Auth::user()->name }}</span>
        <span class="role-badge {{ strtolower(Auth::user()->role) }}">
          {{ Auth::user()->role }}
        </span>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-btn">Logout</button>
        </form>
      </div>
    </div>
    
    <div class="content">
      <h2>Dashboard {{ Auth::user()->role }}</h2>
      <p>Selamat datang di dashboard Lembaga Philanthropy, {{ Auth::user()->name }}.</p>
      
      <!-- Informasi hak akses berdasarkan role -->
      <div class="permissions-info">
        @if(Auth::user()->role === 'crm')
        <h4>Hak Akses CRM/Fundraiser:</h4>
        <ul>
          <li>Input donasi cash/tunai ke aplikasi</li>
          <li>Menyetorkan donasi cash ke bagian keuangan</li>
          <li>Validasi donasi bank transfer berdasarkan konfirmasi donatur</li>
          <li>Menentukan peruntukan donasi (Zakat/Infak/Program lainnya)</li>
        </ul>
        @elseif(Auth::user()->role === 'keuangan')
        <h4>Hak Akses Keuangan:</h4>
        <ul>
          <li>Upload data transaksi donasi dari mutasi bank/rekening koran</li>
          <li>Validasi transaksi donasi dari bank</li>
          <li>Menerima setoran donasi cash/tunai dari CRM/Fundraiser</li>
          <li>Mengakses laporan keuangan lengkap</li>
        </ul>
        @elseif(Auth::user()->role === 'Admin')
        <h4>Hak Akses Administrator:</h4>
        <ul>
          <li>Akses penuh ke semua fitur CRM dan Keuangan</li>
          <li>Mengelola user dan role akses</li>
          <li>Mengakses semua laporan dan data</li>
          <li>Konfigurasi sistem aplikasi</li>
        </ul>
        @endif
      </div>
    </div>
  </div>
</body>
</html>