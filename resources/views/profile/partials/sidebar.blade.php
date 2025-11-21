<!-- resources/views/partials/sidebar.blade.php -->
<nav id="sidebar" class="sidebar">
    <div class="sidebar-brand px-3 py-3">
      <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-2">
        <img src="{{ asset('images/logo.png') }}" alt="logo" style="height:32px;">
        <span class="fw-bold">LAZ - Dashboard</span>
        <span class="role-badge {{ strtolower(Auth::user()->role) }}">
          {{ Auth::user()->role }}
        </span>
      </a>
    </div>
  
    <ul class="nav flex-column px-2">
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
          <i class="bi bi-speedometer2"></i> Dashboard
        </a>
      </li>
  
      <!-- Menu CRM/Fundraiser - hanya tampil untuk role CRM dan Admin -->
      @if(Auth::user()->role === 'CRM' || Auth::user()->role === 'Admin')
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('crm.*')) active @endif" href="#crmSub" data-bs-toggle="collapse" aria-expanded="@if(request()->routeIs('crm.*')) true @else false @endif">
          <i class="bi bi-people"></i> CRM / Fundraiser
        </a>
        <div class="collapse @if(request()->routeIs('crm.*')) show @endif" id="crmSub">
          <ul class="nav flex-column ms-3">
            <li class="nav-item">
              <a class="nav-link @if(request()->routeIs('crm.input_cash')) active @endif" href="{{ route('crm.input_cash') }}">
                <i class="bi bi-cash-coin"></i> Input Donasi Cash
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(request()->routeIs('crm.validasi_transfer')) active @endif" href="{{ route('crm.validasi_transfer') }}">
                <i class="bi bi-bank"></i> Validasi Transfer
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(request()->routeIs('crm.history')) active @endif" href="{{ route('crm.history') }}">
                <i class="bi bi-clock-history"></i> Riwayat Donasi
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endif
  
      <!-- Menu Keuangan - hanya tampil untuk role Keuangan dan Admin -->
      @if(Auth::user()->role === 'Keuangan' || Auth::user()->role === 'Admin')
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('keuangan.*')) active @endif" href="#keuSub" data-bs-toggle="collapse" aria-expanded="@if(request()->routeIs('keuangan.*')) true @else false @endif">
          <i class="bi bi-currency-dollar"></i> Keuangan
        </a>
        <div class="collapse @if(request()->routeIs('keuangan.*')) show @endif" id="keuSub">
          <ul class="nav flex-column ms-3">
            <li class="nav-item">
              <a class="nav-link @if(request()->routeIs('keuangan.upload_mutasi')) active @endif" href="{{ route('keuangan.upload_mutasi') }}">
                <i class="bi bi-upload"></i> Upload Mutasi Bank
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(request()->routeIs('keuangan.validasi_mutasi')) active @endif" href="{{ route('keuangan.validasi_mutasi') }}">
                <i class="bi bi-check-circle"></i> Validasi Mutasi
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(request()->routeIs('keuangan.terima_setoran')) active @endif" href="{{ route('keuangan.terima_setoran') }}">
                <i class="bi bi-wallet2"></i> Terima Setoran Cash
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if(request()->routeIs('keuangan.laporan')) active @endif" href="{{ route('keuangan.laporan') }}">
                <i class="bi bi-clipboard-data"></i> Laporan
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endif

      <!-- Menu Laporan khusus (jika ingin dipisah dari menu Keuangan) -->
      <!-- Uncomment jika ingin menu Laporan terpisah dan bisa diakses semua role -->
      {{-- @if(Auth::user()->role !== 'Admin')
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('laporan.*')) active @endif" href="{{ route('keuangan.laporan') }}">
          <i class="bi bi-clipboard-data"></i> Laporan
        </a>
      </li>
      @endif --}}
  
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn btn-link nav-link text-start" type="submit">
            <i class="bi bi-box-arrow-right"></i> Logout
          </button>
        </form>
      </li>
    </ul>
  </nav>
  
  <style>
    /* minimal sidebar style; Anda bisa integrasikan ke file CSS utama */
    .sidebar {
      width: 240px;
      min-height: 100vh;
      background: #ffffff;
      border-right: 1px solid #e6e6e6;
      position: fixed;
      top: 0;
      left: 0;
      padding-top: 1rem;
    }
    .sidebar .nav-link {
      color: #333;
      padding: .5rem .75rem;
    }
    .sidebar .nav-link.active {
      background: #f0f8ff;
      font-weight: 600;
    }
    .sidebar .nav-link:hover {
      background-color: #f8f9fa;
    }
    
    /* Role badge styling */
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
    
    /* Collapsed menu styling */
    .sidebar .collapse .nav-link {
      padding-left: 2rem;
      font-size: 0.9rem;
    }
    
    body.with-sidebar { 
      padding-left: 240px; 
    }
    
    @media (max-width: 768px) {
      .sidebar { 
        position: relative; 
        width: 100%; 
        min-height: auto; 
        border-right: none; 
      }
      body.with-sidebar { 
        padding-left: 0; 
      }
    }
  </style>