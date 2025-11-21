<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Donasi Cash - Lembaga Philanthropy</title>
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
      margin-left: 240px;
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
      margin-bottom: 20px;
    }
    .content h2 {
      color: #333;
      margin-top: 0;
    }
    /* table style */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    table th, table td {
      padding: 12px 15px;
      text-align: left;
    }
    table th {
      background-color: #f9a825;
      color: #fff;
      font-weight: bold;
    }
    table tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    table tr:hover {
      background-color: #f0f8ff;
    }
    /* Form styling */
    .form-control {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s;
    }
    .form-control:focus {
      outline: none;
      border-color: #f9a825;
      box-shadow: 0 0 0 3px rgba(249, 168, 37, 0.1);
    }
    .form-label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #333;
    }
    .btn-submit {
      background: linear-gradient(135deg, #f9a825, #f57f17);
      border: none;
      color: #fff;
      font-weight: bold;
      padding: 12px 25px;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }
    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(249, 168, 37, 0.3);
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <nav class="sidebar">
    <div class="sidebar-brand">
      LAZ
      <span class="role-badge <?php echo e(strtolower(Auth::user()->role)); ?>">
        <?php echo e(Auth::user()->role); ?>

      </span>
    </div>
    <ul>
      <li>
        <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
          <i class="bi bi-speedometer2"></i> Dashboard
        </a>
      </li>
      
      <!-- Menu khusus untuk CRM/Fundraiser -->
      <?php if(Auth::user()->role === 'crm' || Auth::user()->role === 'crm'): ?>
      <li>
        <a href="<?php echo e(route('crm.input_cash')); ?>" class="<?php echo e(request()->routeIs('crm.input_cash') ? 'active' : ''); ?>">
          <i class="bi bi-cash-coin"></i> Input Donasi Cash
        </a>
      </li>
      <li>
        <a href="<?php echo e(route('crm.validasi_transfer')); ?>" class="<?php echo e(request()->routeIs('crm.validasi_transfer') ? 'active' : ''); ?>">
          <i class="bi bi-bank"></i> Validasi Transfer
        </a>
      </li>
      <?php endif; ?>

      <!-- Menu khusus untuk Keuangan -->
      <?php if(Auth::user()->role === 'Keuangan' || Auth::user()->role === 'Admin'): ?>
      <li>
        <a href="<?php echo e(route('keuangan.upload_mutasi')); ?>" class="<?php echo e(request()->routeIs('keuangan.upload_mutasi') ? 'active' : ''); ?>">
          <i class="bi bi-upload"></i> Upload Mutasi Bank
        </a>
      </li>
      <li>
        <a href="<?php echo e(route('keuangan.validasi_mutasi')); ?>" class="<?php echo e(request()->routeIs('keuangan.validasi_mutasi') ? 'active' : ''); ?>">
          <i class="bi bi-check-circle"></i> Validasi Mutasi
        </a>
      </li>
      <li>
        <a href="<?php echo e(route('keuangan.terima_setoran')); ?>" class="<?php echo e(request()->routeIs('keuangan.terima_setoran') ? 'active' : ''); ?>">
          <i class="bi bi-wallet2"></i> Terima Setoran Cash
        </a>
      </li>
      <?php endif; ?>

      <!-- Menu Laporan untuk semua role -->
      <li>
        <a href="<?php echo e(route('keuangan.laporan')); ?>" class="<?php echo e(request()->routeIs('keuangan.laporan') ? 'active' : ''); ?>">
          <i class="bi bi-clipboard-data"></i> Laporan
        </a>
      </li>
      
      <li>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" class="logout-btn w-100 text-start">
            <i class="bi bi-box-arrow-right"></i> Logout
          </button>
        </form>
      </li>
    </ul>
  </nav>

  <!-- Input Cash content -->
  <div class="dashboard-container">
    <div class="header">
      <h1>Input Donasi Cash</h1>
      <div class="user-info">
        <span><?php echo e(Auth::user()->name); ?></span>
        <span class="role-badge <?php echo e(strtolower(Auth::user()->role)); ?>">
          <?php echo e(Auth::user()->role); ?>

        </span>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" class="logout-btn">Logout</button>
        </form>
      </div>
    </div>
    
    <!-- Success/Error Messages -->
    <?php if(session('success')): ?>
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
      <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
      <i class="bi bi-exclamation-triangle-fill"></i> <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>
    
    <!-- Form Input Donasi -->
    <div class="content">
        <h2 style="margin-bottom:20px; color:#444;">
          <i class="bi bi-cash-coin"></i> Form Input Donasi Cash
        </h2>
        <form method="POST" action="<?php echo e(route('crm.store_cash')); ?>" style="max-width:600px; margin:auto;">
          <?php echo csrf_field(); ?>
      
          <!-- Input Nama Donatur -->
          <div style="margin-bottom: 20px;">
            <label class="form-label">Nama Donatur</label>
            <div style="position: relative;">
              <i class="bi bi-person-fill" style="position:absolute; top:50%; left:10px; transform:translateY(-50%); color:#999; z-index:10;"></i>
              <input type="text" name="donatur" class="form-control"
                style="padding-left:40px; height:45px;"
                placeholder="Masukkan nama donatur..." 
                value="<?php echo e(old('donatur')); ?>" required>
            </div>
            <?php $__errorArgs = ['donatur'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small style="color: #dc3545;"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
      
          <!-- Input Jumlah Donasi -->
          <div style="margin-bottom: 20px;">
            <label class="form-label">Jumlah Donasi</label>
            <div style="position: relative;">
              <i class="bi bi-currency-exchange" style="position:absolute; top:50%; left:10px; transform:translateY(-50%); color:#999; z-index:10;"></i>
              <input type="number" name="jumlah" class="form-control"
                style="padding-left:40px; height:45px;"
                placeholder="Masukkan jumlah donasi..." 
                value="<?php echo e(old('jumlah')); ?>" min="1" required>
            </div>
            <?php $__errorArgs = ['jumlah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small style="color: #dc3545;"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- Input Peruntukan (Optional) -->
          <div style="margin-bottom: 20px;">
            <label class="form-label">Peruntukan Donasi</label>
            <div style="position: relative;">
              <i class="bi bi-tags-fill" style="position:absolute; top:50%; left:10px; transform:translateY(-50%); color:#999; z-index:10;"></i>
              <select name="peruntukan" class="form-control" style="padding-left:40px; height:45px;">
                <option value="">Pilih Peruntukan</option>
                <option value="Zakat" <?php echo e(old('peruntukan') == 'Zakat' ? 'selected' : ''); ?>>Zakat</option>
                <option value="Infak" <?php echo e(old('peruntukan') == 'Infak' ? 'selected' : ''); ?>>Infak</option>
                <option value="Sedekah" <?php echo e(old('peruntukan') == 'Sedekah' ? 'selected' : ''); ?>>Sedekah</option>
                <option value="Program Khusus" <?php echo e(old('peruntukan') == 'Program Khusus' ? 'selected' : ''); ?>>Program Khusus</option>
                <option value="Lainnya" <?php echo e(old('peruntukan') == 'Lainnya' ? 'selected' : ''); ?>>Lainnya</option>
              </select>
            </div>
            <?php $__errorArgs = ['peruntukan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small style="color: #dc3545;"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- Input Keterangan (Optional) -->
          <div style="margin-bottom: 20px;">
            <label class="form-label">Keterangan (Opsional)</label>
            <div style="position: relative;">
              <i class="bi bi-chat-left-text-fill" style="position:absolute; top:15px; left:10px; color:#999; z-index:10;"></i>
              <textarea name="keterangan" class="form-control" 
                style="padding-left:40px; min-height:80px; resize:vertical;"
                placeholder="Keterangan tambahan..."><?php echo e(old('keterangan')); ?></textarea>
            </div>
            <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small style="color: #dc3545;"><?php echo e($message); ?></small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
      
          <!-- Tombol Submit -->
          <div style="text-align: right;">
            <button type="submit" class="btn-submit">
              <i class="bi bi-save"></i> Simpan Donasi
            </button>
          </div>
        </form>
    </div>
      
    <!-- Tabel daftar donasi -->
    <div class="content">
      <h2><i class="bi bi-list-ul"></i> Daftar Donasi Cash</h2>
      
      <!-- Filter/Search (Optional) -->
      <div style="margin-bottom: 20px; display: flex; gap: 15px; align-items: center;">
        <input type="text" id="searchTable" placeholder="Cari donatur..." 
          style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; flex: 1;">
        <span style="color: #666; font-size: 14px;">
          Total: <strong id="totalDonasi">0</strong> donasi
        </span>
      </div>

      <div style="overflow-x: auto;">
        <table id="donasiTable">
          <thead>
            <tr>
              <th style="width: 60px;">No</th>
              <th>Nama Donatur</th>
              <th>Jumlah Donasi</th>
              <th>Peruntukan</th>
              <th>Keterangan</th>
              <th>Tanggal</th>
              <th style="width: 100px;">Status</th>
            </tr>
          </thead>

          <?php
              // Jika variabel $donasi tidak ada, buat default kosong
              $donasi = $donasi ?? [];
          ?>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $donasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
        <td><?php echo e($index + 1); ?></td>
        <td>
            <strong><?php echo e($d->donatur); ?></strong>
        </td>
        <td style="font-weight: bold; color: #28a745;">
            Rp <?php echo e(number_format($d->jumlah, 0, ',', '.')); ?>

        </td>
        <td>
            <?php if($d->peruntukan): ?>
            <span style="background-color: #e3f2fd; color: #1976d2; padding: 2px 8px; border-radius: 12px; font-size: 12px;">
                <?php echo e($d->peruntukan); ?>

            </span>
            <?php else: ?>
            <span style="color: #999; font-style: italic;">-</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if($d->keterangan): ?>
            <?php echo e(Str::limit($d->keterangan, 50)); ?>

            <?php else: ?>
            <span style="color: #999; font-style: italic;">-</span>
            <?php endif; ?>
        </td>
        <td><?php echo e($d->created_at ? $d->created_at->format('d-m-Y H:i') : '-'); ?></td>
        <td>
            <?php
            $status = $d->status;
            $statusLabel = match($status) {
                'pending' => 'Pending',
                'divalidasi' => 'Telah Divalidasi',
                'ditolak' => 'Ditolak',
                default => ucfirst($status),
            };
            $statusColor = match($status) {
                'pending' => '#fff3cd',
                'divalidasi' => '#d4edda',
                'ditolak' => '#f8d7da',
                default => '#e2e3e5',
            };
            $textColor = match($status) {
                'pending' => '#856404',
                'divalidasi' => '#155724',
                'ditolak' => '#721c24',
                default => '#818182',
            };
            $icon = match($status) {
                'pending' => 'bi-clock-fill',
                'divalidasi' => 'bi-check-circle-fill',
                'ditolak' => 'bi-x-circle-fill',
                default => 'bi-info-circle-fill',
            };
            ?>
    
            <span style="background-color: <?php echo e($statusColor); ?>; color: <?php echo e($textColor); ?>; padding: 2px 8px; border-radius: 12px; font-size: 12px;">
            <i class="bi <?php echo e($icon); ?>"></i> <?php echo e($statusLabel); ?>

            </span>
        </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
        <td colspan="7" style="text-align:center; color: #999; font-style: italic; padding: 40px;">
            <i class="bi bi-inbox" style="font-size: 48px; display: block; margin-bottom: 10px; opacity: 0.5;"></i>
            Belum ada donasi cash yang diinput
        </td>
        </tr>
        <?php endif; ?>
    </tbody>
    
        </table>
      </div>
    </div>

  </div>

  <script>
    // Simple search functionality
    document.getElementById('searchTable').addEventListener('keyup', function() {
      const searchValue = this.value.toLowerCase();
      const table = document.getElementById('donasiTable');
      const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
      let visibleCount = 0;

      for (let i = 0; i < rows.length; i++) {
        const donaturCell = rows[i].getElementsByTagName('td')[1];
        if (donaturCell) {
          const donaturName = donaturCell.textContent.toLowerCase();
          if (donaturName.includes(searchValue)) {
            rows[i].style.display = '';
            visibleCount++;
          } else {
            rows[i].style.display = 'none';
          }
        }
      }
      
      document.getElementById('totalDonasi').textContent = visibleCount;
    });

    // Initialize total count
    document.addEventListener('DOMContentLoaded', function() {
      const table = document.getElementById('donasiTable');
      const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
      const totalRows = rows.length > 0 && rows[0].getElementsByTagName('td').length === 1 ? 0 : rows.length;
      document.getElementById('totalDonasi').textContent = totalRows;
    });
  </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\donasiq-app\resources\views/crm/input_cash.blade.php ENDPATH**/ ?>