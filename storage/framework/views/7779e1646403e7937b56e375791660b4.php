<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Lembaga Philanthropy</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f4f7;
      margin: 0;
      padding: 0;
    }
    .dashboard-container {
      max-width: 1200px;
      margin: 0 auto;
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
  </style>
</head>
<body>
  <div class="dashboard-container">
    <div class="header">
      <h1>Dashboard Lembaga Philanthropy</h1>
      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="logout-btn">Logout</button>
      </form>
    </div>
    
    <div class="content">
      <h2>Ini Dashboard</h2>
      <p>Selamat datang di dashboard Lembaga Philanthropy.</p>
    </div>
  </div>
</body>
</html>
<?php /**PATH C:\laragon\www\donasiq-app\resources\views/dashboard.blade.php ENDPATH**/ ?>