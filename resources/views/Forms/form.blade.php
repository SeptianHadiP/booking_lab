<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Praktikum | Fakultas Ilmu Komputer</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background: linear-gradient(120deg, #f1f5f9, #e2e8f0);
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background-color: #ffffff;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #1e293b;
    }

    label {
      display: block;
      margin-top: 18px;
      margin-bottom: 6px;
      color: #334155;
      font-weight: 600;
    }

    input[type="text"],
    input[type="date"],
    input[type="file"],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #cbd5e1;
      border-radius: 10px;
      font-size: 14px;
      background-color: #f8fafc;
      transition: all 0.3s ease;
    }

    input:focus,
    select:focus,
    textarea:focus {
      border-color: #3b82f6;
      outline: none;
      background-color: #fff;
    }

    textarea {
      resize: vertical;
    }

    .btn-submit {
      width: 100%;
      background-color: #3b82f6;
      color: #fff;
      padding: 14px;
      margin-top: 30px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
      background-color: #2563eb;
    }

    @media (max-width: 640px) {
      .form-container {
        padding: 25px 20px;
      }
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Pendaftaran & Penjadwalan Praktikum</h2>

    <form action="/submit-praktikum" method="post" enctype="multipart/form-data">
      <label for="nama">Nama Lengkap Dosen</label>
      <input type="text" id="nama" name="nama_dosen" placeholder="Masukkan nama lengkap dosen" required>

      <label for="kelas">Kelas</label>
      <input type="text" id="kelas" name="kelas" placeholder="Contoh: F1A1" required>

      <label for="matkul">Mata Kuliah</label>
      <select id="matkul" name="mata_kuliah" required>
        <option value="">-- Pilih Mata Kuliah --</option>
        <option value="Analisis dan Desain Berorientasi Objek">Analisis dan Desain Berorientasi Objek</option>
        <option value="Jaringan Komputer II">Jaringan Komputer II</option>
        <option value="Pemograman Web">Pemograman Web</option>
        <option value="Penambangan Data">Penambangan Data</option>
        <option value="Pengantar Keamanan Komputer">Pengantar Keamanan Komputer</option>
        <option value="Sistem Basis Data">Sistem Basis Data</option>
        <option value="Statistika dan Probabilitas">Statistika dan Probabilitas</option>
      </select>

      <label for="tanggal">Tanggal Praktikum</label>
      <input type="date" id="tanggal" name="tanggal_praktikum" required>

      <label for="waktu">Waktu Praktikum</label>
      <select id="waktu" name="waktu_praktikum" required>
        <option value="">-- Pilih Waktu --</option>
        <option value="08:00 - 10:30">08:00 - 10:30</option>
        <option value="10:46 - 12:30">10:46 - 12:30</option>
        <option value="13:30 - 15:30">13:30 - 15:30</option>
        <option value="15:45 - 18:00">15:45 - 18:00</option>
      </select>

      <label for="modul">Upload Modul Praktikum</label>
      <input type="file" id="modul" name="modul_praktikum" accept=".pdf,.doc,.docx" required>

      <label for="tools">Tools / Software yang Digunakan</label>
      <textarea id="tools" name="tools_software" rows="3" placeholder="Contoh: Visual Studio Code, XAMPP, Wireshark" required></textarea>

      <button type="submit" class="btn-submit">Daftar Praktikum</button>
    </form>
  </div>

</body>
</html>
