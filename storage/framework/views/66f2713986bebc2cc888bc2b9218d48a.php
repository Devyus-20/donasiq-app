<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Donasi - Lembaga Philanthropy</title>
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

  <!-- Content -->
  <div class="dashboard-container">
    <div class="header">
      <h1>Laporan Donasi Bulanan</h1>
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
      <h2>Rekap Donasi</h2>
      <p>Berikut adalah laporan total donasi bulanan per donor per kantor.</p>

      <?php if($laporan->isEmpty()): ?>
        <div style="padding:10px; background:#f8d7da; color:#721c24; border-radius:5px; margin-bottom:15px;">
          <i class="bi bi-inbox"></i> Belum ada data donasi yang tersedia.
        </div>
      <?php else: ?>
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Donatur</th>
              <th>Kantor</th>
              <th>Bulan</th>
              <th>Total Donasi</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($index + 1); ?></td>
              <td><?php echo e($row->nama_donatur); ?></td>
              <td><?php echo e($row->nama_kantor); ?></td>
              <td><?php echo e($row->bulan); ?></td>
              <td style="font-weight:bold; color:#28a745;">
                Rp <?php echo e(number_format($row->total_donasi, 0, ',', '.')); ?>

              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\donasiq-app\resources\views/keuangan/laporan.blade.php ENDPATH**/ ?>