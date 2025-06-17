<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pendaftaran Praktikum</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f5f9;
      margin: 0;
      padding: 20px;
    }

    h2 {
      color: #2c3e50;
      text-align: center;
    }

    form {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      max-width: 700px;
      margin: 0 auto 30px auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    input[type="file"] {
      padding: 5px;
    }

    button {
      margin-top: 20px;
      background: #2c3e50;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      margin: 0 auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }

    th {
      background: #34495e;
      color: #fff;
    }
  </style>
</head>
<body>

  <h2>Form Pendaftaran & Penentuan Jadwal Praktikum<br>Fakultas Ilmu Komputer</h2>

  <form>
    <label>Nama Lengkap Dosen</label>
    <input type="text" placeholder="Masukkan nama dosen">

    <label>Mata Kuliah</label>
    <select>
      <option>Analisis dan Desain Berorientasi Objek</option>
      <option>Jaringan Komputer II</option>
      <option>Pemograman Web</option>
      <option>Penambangan Data</option>
      <option>Pengantar Keamanan Komputer</option>
      <option>Sistem Basis Data</option>
      <option>Statistika dan Probabilitas</option>
    </select>

    <label>Kelas</label>
    <input type="text" placeholder="Contoh: IF-22A">

    <label>Tanggal Praktikum</label>
    <input type="date">

    <label>Waktu Praktikum</label>
    <select>
      <option>Sesi 1 (08:00-10:30)</option>
      <option>Sesi 2 (10:46-12:30)</option>
      <option>Sesi 3 (13:30-15:30)</option>
      <option>Sesi 4 (15:45-18:00)</option>
    </select>
    <label>Modul Praktikum</label>
    <input type="file">

    <label>Tools / Software yang digunakan</label>
    <input type="text" placeholder="Contoh: Visual Studio Code, Wireshark">

    <button type="submit">Kirim</button>
  </form>

  <h2>Data Pendaftaran</h2>

  <table>
    <thead>
      <tr>
        <th>Nama Dosen</th>
        <th>Mata Kuliah</th>
        <th>Kelas</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Modul</th>
        <th>Tools</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Dr. Rina Sari</td>
        <td>Jaringan Komputer II</td>
        <td>IF-22B</td>
        <td>2025-07-05</td>
        <td>Sesi 2</td>
        <td>modul_jaringan.pdf</td>
        <td>Wireshark</td>
      </tr>
      <!-- Tambahkan baris lain sesuai data -->
    </tbody>
  </table>

</body>
</html>
