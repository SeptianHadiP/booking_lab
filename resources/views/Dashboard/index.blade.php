<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Responsive Admin Dashboard</title>
  <!-- <link rel="stylesheet" href="public/css/dashboard.css"> -->

  <style>
    * {
  margin:0; padding:0; box-sizing:border-box;
}
body {
  display:flex; font-family: 'Nunito', sans-serif; background:#F1F5F9;
}
.sidebar {
  position:fixed; left:0; width:250px; height:100vh; background:#0D417C; padding:20px;
  transition: width 0.3s;
}
.sidebar.collapsed { width:70px; }
.sidebar .logo { color:#fff; font-size:1.5em; font-weight:bold; text-align:center; margin-bottom:25px; }
.sidebar ul { list-style:none; }
.sidebar ul li { margin:20px 0; }
.sidebar ul li a {
  color:#D0D5DB; text-decoration:none; display:flex; align-items:center;
  padding:8px; border-radius:8px; transition: background 0.2s;
}
.sidebar ul li.active a,
.sidebar ul li a:hover {
  background:#1E3A8A; color:#fff;
}
.sidebar ul li a i { font-size:1.2em; margin-right:10px; }

.main-content {
  margin-left:250px; width:100%; transition:margin-left 0.3s;
}
.main-content.collapsed { margin-left:70px; }
nav {
  background:#fff; padding:15px 20px; display:flex; justify-content:space-between;
  align-items:center; box-shadow:0 1px 4px rgba(0,0,0,0.1);
}
.profile img {
  height:40px; width:40px; border-radius:50%;
}

main { padding:20px; }
.cards {
  display:grid; grid-template-columns: repeat(auto-fit, minmax(180px,1fr));
  gap:20px; margin-top:20px;
}
.card {
  background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.05);
  padding:20px; text-align:center;
}
.card .number {
  font-size:2.5em; font-weight:bold; color:#0D417C;
}
.card .card-name {
  margin-top:10px; font-size:1em; color:#6B7280;
}

  </style>

</head>
<body>
  <div class="sidebar">
    <div class="logo">MyAdmin</div>
    <ul>
      <li class="active"><a href="#"><i class="bx bx-grid-alt"></i> Dashboard</a></li>
      <li><a href="#"><i class="bx bx-user"></i> Users</a></li>
      <li><a href="#"><i class="bx bx-message-square-detail"></i> Messages</a></li>
      <li><a href="#"><i class="bx bx-pie-chart-alt-2"></i> Analytics</a></li>
      <li><a href="#"><i class="bx bx-folder"></i> File Manager</a></li>
      <li><a href="#"><i class="bx bx-cart-alt"></i> Orders</a></li>
      <li><a href="#"><i class="bx bx-heart"></i> Saved</a></li>
      <li><a href="#"><i class="bx bx-cog"></i> Settings</a></li>
    </ul>
  </div>
  <section class="main-content">
    <nav>
      <div class="sidebar-toggle"><i class="bx bx-menu"></i></div>
      <div class="profile">
        <img src="https://i.pravatar.cc/40" alt="Admin">
      </div>
    </nav>
    <main>
      <h1>Dashboard</h1>
      <div class="cards">
        <div class="card"><div class="number">4</div><div class="card-name">Active Labs</div></div>
        <div class="card"><div class="number">0</div><div class="card-name">Total Bookings</div></div>
        <div class="card"><div class="number">0</div><div class="card-name">Pending Approval</div></div>
        <div class="card"><div class="number">0</div><div class="card-name">Today's Bookings</div></div>
      </div>
    </main>
  </section>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script src="dashboard.js"></script>
</body>
</html>
