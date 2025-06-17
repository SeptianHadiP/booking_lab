<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Sistem Praktikum</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; font-family:'Inter',sans-serif; }
    body {
      margin: 0; padding: 0;
      background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
      display: flex; align-items: center; justify-content: center;
      height: 100vh;
    }
    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      padding: 40px 30px;
      width: 100%; max-width: 360px;
      text-align: center;
    }
    .card img {
      width: 80px; margin-bottom: 20px;
    }
    .card h2 {
      margin: 0 0 25px;
      color: #1e293b;
      font-weight: 600;
    }
    .card label {
      display: block;
      text-align: left;
      margin-top: 15px;
      margin-bottom: 5px;
      color: #334155;
      font-weight: 500;
    }
    .card input[type="text"],
    .card input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      font-size: 14px;
      background: #f8fafc;
      transition: border-color 0.3s;
    }
    .card input:focus {
      border-color: #3b82f6;
      outline: none;
      background: #fff;
    }
    .card .btn {
      margin-top: 25px;
      width: 100%;
      padding: 12px;
      background: #10b981;
      color: #fff;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .card .btn:hover {
      background: #059669;
    }
    .card .links {
      margin-top: 15px;
    }
    .card .links a {
      color: #3b82f6;
      font-size: 14px;
      text-decoration: none;
      margin: 0 5px;
    }
    .card .links a:hover {
      text-decoration: underline;
    }
    .card .footer {
      margin-top: 20px;
      font-size: 13px;
      color: #64748b;
    }
  </style>
</head>
<body>

  <div class="card">
    <!-- Ganti src dengan logo kampus atau sistem yang sesuai -->
    <img src="https://sia.ubharajaya.ac.id/assets/img/logo.png" alt="Logo SIA">

    <h2>Login Praktikum</h2>

    <form action="/dashboard" method="POST">
      <label for="username">Username / NIP</label>
      <input type="text" id="username" name="username" placeholder="Nama pengguna" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Kata sandi" required>

      <button type="submit" class="btn" >Masuk</button>
        <a href="/dashboard" class="login-link"><i class="fas fa-sign-in-alt"></i> Login</a>
    </form>

    <div class="links">
      <a href="/forgot">Lupa Password?</a> |
      <a href="/register">Buat Akun Baru</a>
    </div>

    <div class="footer">
      &copy; 2025 Fakultas Ilmu Komputer
    </div>
  </div>

</body>
</html>
