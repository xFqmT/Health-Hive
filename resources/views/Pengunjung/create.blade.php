<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Siswa</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('images/7283494.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .form-container {
            width: 350px;
            margin: 100px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px #aaa;
            text-align: center;
        }
        .form-group {
            text-align: left;
            margin-bottom: 12px;
        }
        label {
            display: inline-block;
            width: 100px;
        }
        input, select {
            width: 210px;
            padding: 5px;
        }
        button {
            margin-top: 10px;
            padding: 6px 20px;
            background-color: #60a5fa;
            color: white;
            border: none;
            cursor: pointer;
        }
        .back-btn {
            position: absolute;
            left: 20px;
            top: 20px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            font-weight: bold;
        }
    </style>
</head>
<body>
<a href="{{ route('dashboard') }}" class="back-btn">← Kembali</a>

<div class="form-container">
    <h2>Tambah Data Siswa</h2>
    <form method="POST" action="{{ route('pengunjung.store') }}">
        @csrf
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required>
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" required>
                <option value="">Pilih Kelas</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
        <div class="form-group">
            <label>Angkatan</label>
            <select name="angkatan" required>
                <option value="">Pilih Angkatan</option>
                <?php
                $currentYear = date('Y');
                for ($year = $currentYear; $year >= 2000; $year--) {
                    echo "<option value='$year'>$year</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <select name="jurusan" required>
                <option value="">Pilih Jurusan</option>
                <option value="PPLG">PPLG</option>
                <option value="TJKT">TJKT</option>
                <option value="DKV">DKV</option>
                <option value="AKL">AKL</option>
                <option value="ANIMASI">ANIMASI</option>
                <option value="ULP">ULP</option>
                <option value="MPLB">MPLB</option>
                <option value="PM">PM</option>
            </select>
        </div>
        <div class="form-group">
            <label>Keluhan</label>
            <input type="text" name="keluhan" required>
        </div>
        <div class="form-group">
            <label>Obat</label>
            <input type="text" name="terapi" required>
        </div>
        <button type="submit">Kirim</button>
    </form>
</div>
</body>
</html>
