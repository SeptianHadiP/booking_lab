<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laboratory Booking System | Bhayangkara University</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    * {margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif;}
    body {background: #0f172a; color: #e2e8f0; line-height: 1.6;}

    /* Header */
    header {
      width: 100%;
      position: fixed;
      top: 0; left: 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 40px;
      transition: background 0.4s, box-shadow 0.4s;
      z-index: 1000;
      background: transparent;
    }
    header.scrolled {background: #7c3aed; box-shadow: 0 4px 10px rgba(0,0,0,0.3);}
    header h1 {font-size: 20px; font-weight: 700; display: flex; align-items: center; gap: 8px; color: #fff;}
    nav ul {list-style: none; display: flex; gap: 24px;}
    nav ul li a {color: #f9fafb; text-decoration: none; font-size: 15px; font-weight: 500; transition: 0.3s;}
    nav ul li a:hover {color: #fde68a;}
    .header-right {display: flex; align-items: center; gap: 20px;}
    .date {font-size: 14px; color: #f3f4f6;}
    .login-link {
      color: #111827; text-decoration: none; font-size: 14px;
      background: #facc15; padding: 8px 14px; border-radius: 6px;
      font-weight: 600; transition: 0.3s;
    }
    .login-link:hover {background: #fde047;}

    /* Hero */
    .hero {
      text-align: center; padding: 120px 20px 60px;
      background: linear-gradient(135deg,#7c3aed,#4f46e5);
      min-height: 100vh; display: flex; flex-direction: column;
      justify-content: center; align-items: center;
      max-width: 100%; margin: 0;
    }
    .hero h2 {font-size: 42px; font-weight: 700; margin-bottom: 16px; color: #fff;}
    .hero p {font-size: 18px; max-width: 700px; margin: 0 auto 30px; color: #e0e7ff;}
    .btn {
      background: #facc15; color: #111827; padding: 14px 32px;
      border-radius: 8px; font-size: 16px; text-decoration: none;
      font-weight: 600; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px;
    }
    .btn:hover {background: #fde047;}

    /* Features */
    .features {
      display: flex; justify-content: center; flex-wrap: wrap;
      gap: 28px; padding: 70px 20px; background: #111827;
      max-width: 100%; margin: 0;
    }
    .feature {
      background: #1e293b; padding: 30px 22px;
      border-radius: 14px; width: 280px; text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .feature:hover {transform: translateY(-6px); box-shadow: 0 12px 24px rgba(0,0,0,0.4);}
    .feature i {font-size: 40px; margin-bottom: 14px; color: #38bdf8;}
    .feature h3 {color: #facc15; margin-bottom: 10px; font-size: 20px;}
    .feature p {color: #cbd5e1; font-size: 15px;}

    /* Generic section */
    section {padding: 70px 20px;}

    /* About */
    .about {max-width: 800px; margin: 0 auto;}
    .about h4 {font-size: 24px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; color: #c084fc;}
    .about ul {padding-left: 20px; margin: 18px 0;}
    .about li {margin-bottom: 10px;}

    /* How It Works */
    .steps {display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;}
    .step {background: #1e293b; padding: 25px; border-radius: 12px; width: 260px; text-align: center;}
    .step i {font-size: 36px; color: #facc15; margin-bottom: 12px;}
    .step h5 {font-size: 18px; margin-bottom: 8px; color: #fff;}

    /* Benefits */
    .benefits {background: #1e293b; text-align: center;}
    .benefits h4 {color: #38bdf8; font-size: 24px; margin-bottom: 24px;}
    .benefits-list {display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;}
    .benefit {background: #0f172a; padding: 20px; border-radius: 10px; width: 260px;}

    /* Testimonials */
    .testimonials {text-align: center;}
    .testimonial-cards {display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-top: 20px;}
    .card {background: #1e293b; padding: 20px; border-radius: 12px; width: 280px;}
    .card p {font-size: 15px; color: #e2e8f0; margin-bottom: 12px;}
    .card span {font-size: 14px; color: #facc15; font-weight: 600;}

    /* Contact */
    .contact {background: #1e293b; text-align: center;}
    .contact h4 {font-size: 22px; margin-bottom: 14px; color: #38bdf8;}
    .contact p {margin-bottom: 6px; color: #e2e8f0;}

    /* CTA */
    .cta {
      background: linear-gradient(135deg,#4f46e5,#7c3aed);
      text-align: center; padding: 80px 20px; color: #fff;
    }
    .cta h3 {font-size: 28px; margin-bottom: 20px;}
    .cta a {background: #facc15; color: #111827; padding: 14px 28px; border-radius: 8px; font-weight: 600; text-decoration: none;}
    .cta a:hover {background: #fde047;}

    /* Footer */
    footer {text-align: center; padding: 25px; font-size: 14px; background: #111827; color: #94a3b8; margin-top: 0;}
    html { scroll-behavior: smooth; }
  </style>
</head>
<body>

  <header id="main-header">
    <h1><i class="fas fa-university"></i> Bhayangkara University</h1>
    <nav>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#how">How It Works</a></li>
        <li><a href="#benefits">Benefits</a></li>
        <li><a href="#testimonials">Testimonials</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
    <div class="header-right">
      <span class="date" id="current-date"></span>
      <a href="{{ route('login') }}" class="login-link"><i class="fas fa-sign-in-alt"></i> Login</a>
    </div>
  </header>

  <section id="home" class="hero">
    <h2><i class="fas fa-flask"></i> Laboratory Booking System</h2>
    <p>Mudahkan reservasi laboratorium di Universitas Bhayangkara. Kelola jadwal, hindari bentrok, dan optimalkan penggunaan sumber daya secara efisien.</p>
    <a href="{{ route('login') }}" class="btn"><i class="fas fa-sign-in-alt"></i> Mulai Login</a>
  </section>

  <section class="features">
    <div class="feature"><i class="fas fa-calendar-check"></i><h3>Easy Booking</h3><p>Reservasi laboratorium cepat & intuitif dengan pengecekan real-time.</p></div>
    <div class="feature"><i class="fas fa-clock"></i><h3>Schedule Management</h3><p>Atur jadwal & hindari bentrokan dengan kalender terintegrasi.</p></div>
    <div class="feature"><i class="fas fa-users-cog"></i><h3>Multi-User Access</h3><p>Akses terpisah untuk dosen & admin sesuai kebutuhan.</p></div>
  </section>

  <section id="about" class="about">
    <h4><i class="fas fa-info-circle"></i> Tentang Sistem</h4>
    <p>Sistem Booking Laboratorium ini dirancang untuk membantu Universitas Bhayangkara dalam mengelola sumber daya laboratorium secara efisien.</p>
    <ul>
      <li>✅ Membooking laboratorium untuk kelas & riset</li>
      <li>✅ Melihat ketersediaan secara real-time</li>
      <li>✅ Mengelola riwayat booking</li>
      <li>✅ Akses dari perangkat apapun (responsive)</li>
    </ul>
  </section>

  <section id="how">
    <h4 style="text-align:center; margin-bottom:30px; color:#c084fc;"><i class="fas fa-cogs"></i> How It Works</h4>
    <div class="steps">
      <div class="step"><i class="fas fa-user-plus"></i><h5>1. Login</h5><p>Masuk dengan akun universitas Anda.</p></div>
      <div class="step"><i class="fas fa-calendar-alt"></i><h5>2. Pilih Jadwal</h5><p>Cek ketersediaan laboratorium.</p></div>
      <div class="step"><i class="fas fa-check-circle"></i><h5>3. Booking</h5><p>Konfirmasi pemesanan dan gunakan lab sesuai jadwal.</p></div>
    </div>
  </section>

  <section id="benefits" class="benefits">
    <h4><i class="fas fa-star"></i> Benefits</h4>
    <div class="benefits-list">
      <div class="benefit">⏱ Efisiensi waktu pemesanan</div>
      <div class="benefit">📊 Monitoring pemakaian lab</div>
      <div class="benefit">📱 Akses mobile friendly</div>
      <div class="benefit">🔒 Data aman & terintegrasi</div>
    </div>
  </section>

  <section id="testimonials" class="testimonials">
    <h4 style="color:#facc15; font-size:24px;"><i class="fas fa-comments"></i> Testimonials</h4>
    <div class="testimonial-cards">
      <div class="card"><p>"Sangat membantu! Booking jadi lebih cepat dan tidak bentrok."</p><span>- Dosen Informatika</span></div>
      <div class="card"><p>"User friendly banget, saya bisa atur jadwal riset dengan mudah."</p><span>- Mahasiswa</span></div>
      <div class="card"><p>"Sebagai admin, saya bisa memantau semua penggunaan lab."</p><span>- Admin Fakultas</span></div>
    </div>
  </section>

  <section id="contact" class="contact">
    <h4><i class="fas fa-envelope"></i> Contact Us</h4>
    <p>Email: labbooking@bhayangkara.ac.id</p>
    <p>Phone: (021) 1234-5678</p>
    <p>Alamat: Jl. Bhayangkara Raya No. 45, Jakarta</p>
  </section>

  <section class="cta">
    <h3>Siap Mengoptimalkan Laboratorium?</h3>
    <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login Sekarang</a>
  </section>

  <footer>© 2025 Bhayangkara University · Laboratory Booking System</footer>

  <script>
    const dateEl = document.getElementById("current-date");
    const today = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
    dateEl.textContent = today.toLocaleDateString('id-ID', options);

    const header = document.getElementById("main-header");
    window.addEventListener("scroll", () => {
      if (window.scrollY > 50) {header.classList.add("scrolled");}
      else {header.classList.remove("scrolled");}
    });
  </script>
</body>
</html>
