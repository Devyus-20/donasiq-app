<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Transfer - Lembaga Philanthropy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f4f7;
      margin: 0;
      padding: 0;
      display: flex;
    }
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
    .logout-btn {
      background-color: #f9a825;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
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
    }
    .content h2 {
      color: #333;
      margin-top: 0;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table th, table td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }
    table th {
      background-color: #f9f9f9;
    }
    .btn-validate {
      background-color: #4caf50;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
    }
    .btn-validate:hover {
      background-color: #43a047;
    }
    .role-badge {
      font-size: 12px;
      padding: 2px 8px;
      border-radius: 12px;
      background-color: #f0f0f0;
      margin-left: 10px;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <nav class="sidebar">
    <div class="sidebar-brand">
      LAZ
      <span class="role-badge"><?php echo e(Auth::user()->role); ?></span>
    </div>
    <ul>
      <li>
        <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
          <i class="bi bi-speedometer2"></i> Dashboard
        </a>
      </li>
      <?php if(in_array(strtolower(Auth::user()->role), ['crm'])): ?>
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
      <?php if(in_array(strtolower(Auth::user()->role), ['keuangan', 'admin'])): ?>
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

  <!-- Validasi Transfer content -->
  <div class="dashboard-container">
    <div class="header">
      <h1>Validasi Transfer</h1>
      <div>
        <span><?php echo e(Auth::user()->name); ?></span>
        <span class="role-badge"><?php echo e(Auth::user()->role); ?></span>
        <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline;">
          <?php echo csrf_field(); ?>
          <button type="submit" class="logout-btn">Logout</button>
        </form>
      </div>
    </div>

    <div class="content">
      <h2>Daftar Transfer</h2>
      <p>Berikut adalah daftar transfer yang perlu divalidasi.</p>

      <?php if(session('success')): ?>
        <div style="padding:10px; background:#d4edda; color:#155724; border-radius:5px; margin-bottom:15px;">
          <?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>

      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Donatur</th>
            <th>Jumlah</th>
            <th>Peruntukan</th>
            <th>Tanggal Setor</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><?php echo e($index + 1); ?></td>
            <td><?php echo e($t->donatur ?? '-'); ?></td>
            <td>Rp <?php echo e(number_format($t->jumlah, 0, ',', '.')); ?></td>
            <td><?php echo e($t->peruntukan ?? '-'); ?></td>
            <td><?php echo e($t->tanggal_setor ? \Carbon\Carbon::parse($t->tanggal_setor)->format('d-m-Y H:i') : '-'); ?></td>
            <td>
              <?php
                $status = $t->status;
                $statusLabel = match($status) {
                    'pending' => 'Menunggu Disetor',
                    'disetor' => 'Menunggu Validasi',
                    'diterima_keuangan' => 'Diterima Keuangan',
                    'selesai' => 'Selesai',
                    default => ucfirst($status),
                };
                $statusColor = match($status) {
                    'pending' => '#fff3cd',
                    'disetor' => '#d1ecf1',
                    'diterima_keuangan' => '#d4edda',
                    'selesai' => '#cce5ff',
                    default => '#e2e3e5',
                };
                $textColor = match($status) {
                    'pending' => '#856404',
                    'disetor' => '#0c5460',
                    'diterima_keuangan' => '#155724',
                    'selesai' => '#004085',
                    default => '#818182',
                };
              ?>
              <span style="background-color: <?php echo e($statusColor); ?>; color: <?php echo e($textColor); ?>; padding:2px 8px; border-radius:12px; font-size:12px;">
                <?php echo e($statusLabel); ?>

              </span>
            </td>
            <td>
              <?php if($status === 'pending'): ?>
              <form method="POST" action="<?php echo e(route('crm.confirm_transfer', $t->id)); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-validate"><i class="bi bi-check-circle"></i> Validasi</button>
              </form>
              <?php elseif($status === 'diterima_keuangan'): ?>
                <span style="color: green; font-weight: bold;">✔</span>
              <?php else: ?>
                <span>-</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="7" style="text-align:center; color:#999; font-style:italic; padding:40px;">
              <i class="bi bi-inbox" style="font-size:48px; display:block; margin-bottom:10px; opacity:0.5;"></i>
              Belum ada donasi cash yang perlu divalidasi
            </td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
      
    </div>
  </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\donasiq-app\resources\views/crm/validasi_transfer.blade.php ENDPATH**/ ?>