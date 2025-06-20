<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laboratory Booking System</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
    }
    body {
      background-color: #111827;
      color: #ffffff;
      line-height: 1.6;
    }
    header {
      background-color: #7c3aed;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #fff;
    }
    header h1 {
      font-size: 20px;
    }
    .login-link {
      color: #d1d5db;
      text-decoration: none;
      font-size: 14px;
    }
    .container {
      text-align: center;
      padding: 60px 20px 30px;
    }
    .container h2 {
      font-size: 32px;
      color: #c084fc;
      margin-bottom: 10px;
    }
    .container p {
      max-width: 600px;
      margin: 0 auto 30px;
      font-size: 16px;
      color: #cbd5e1;
    }
    .btn {
      background-color: #6d28d9;
      color: white;
      border: none;
      padding: 14px 28px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      text-decoration: none;
    }
    .features {
      display: flex;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
      margin-top: 50px;
      margin-bottom: 60px;
    }
    .feature {
      width: 250px;
      text-align: center;
    }
    .feature i {
      font-size: 36px;
      margin-bottom: 12px;
      display: inline-block;
      color: #38bdf8;
    }
    .feature h3 {
      margin-bottom: 8px;
      font-size: 18px;
      color: #facc15;
    }
    .feature p {
      font-size: 14px;
      color: #cbd5e1;
    }
    .about {
      max-width: 700px;
      margin: 0 auto;
      padding: 40px 20px;
      background-color: #1e293b;
      border-radius: 12px;
    }
    .about h4 {
      font-size: 20px;
      margin-bottom: 16px;
      border-bottom: 1px solid #475569;
      padding-bottom: 8px;
    }
    .about ul {
      text-align: left;
      padding-left: 20px;
    }
    .about li {
      margin-bottom: 10px;
    }
    .footer {
      text-align: center;
      padding: 20px;
      font-size: 14px;
      color: #94a3b8;
      background-color: #0f172a;
      margin-top: 40px;
    }
  </style>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

  <header>
    <h1><i class="fas fa-university"></i> Bhayangkara University</h1>
    <a href="/login" class="login-link"><i class="fas fa-sign-in-alt"></i> Login</a>
  </header>

  <div class="container">
    <h2><i class="fas fa-flask"></i> Laboratory Booking System</h2>
    <p>
      Streamline your laboratory reservations at Bhayangkara University. Book labs, manage schedules, and optimize resource allocation with ease.
    </p>
    <a href="{{ route('login') }}" class="btn"><i class="fas fa-sign-in-alt"></i> Login to Get Started</a>
  </div>

  <div class="features">
    <div class="feature">
      <i class="fas fa-calendar-check"></i>
      <h3>Easy Booking</h3>
      <p>Quick and intuitive laboratory booking system with real-time availability checking.</p>
    </div>
    <div class="feature">
      <i class="fas fa-clock"></i>
      <h3>Schedule Management</h3>
      <p>View schedules, manage bookings, and avoid conflicts with our integrated calendar system.</p>
    </div>
    <div class="feature">
      <i class="fas fa-users-cog"></i>
      <h3>Multi-User Access</h3>
      <p>Separate access levels for lecturers and administrators with appropriate permissions.</p>
    </div>
  </div>

  <div class="about">
    <h4><i class="fas fa-info-circle"></i> About the System</h4>
    <p>The Laboratory Booking System is designed to help Bhayangkara University manage laboratory resources efficiently. Faculty members can:</p>
    <ul>
      <li>✅ Book laboratories for classes and research</li>
      <li>✅ View real-time availability</li>
      <li>✅ Manage their booking history</li>
      <li>✅ Access from any device with responsive design</li>
    </ul>
    <p>Administrators have additional capabilities to oversee all bookings and manage laboratory resources across the university.</p>
  </div>

  <div class="footer">
    © 2025 Bhayangkara University. All rights reserved.<br>
    Laboratory Booking System
  </div>

</body>
</html>
