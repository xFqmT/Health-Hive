<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Siswa</title>
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
    <h2>Edit Data Siswa</h2>
    <form method="POST" action="{{ route('pengunjung.update', $pengunjung->id_pengunjung) }}">
        @csrf
        @method('PUT')
       <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ $pengunjung->tanggal }}" required>
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $pengunjung->nama }}" required>
        </div>
        <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" required>
                <option value="">Pilih Kelas</option>
                <option value="10" {{ $pengunjung->kelas == '10' ? 'selected' : '' }}>10</option>
                <option value="11" {{ $pengunjung->kelas == '11' ? 'selected' : '' }}>11</option>
                <option value="12" {{ $pengunjung->kelas == '12' ? 'selected' : '' }}>12</option>
            </select>
        </div>
        <div class="form-group">
            <label>Angkatan</label>
            <select name="angkatan" required>
                <option value="">Pilih Angkatan</option>
                <?php
                $currentYear = date('Y');
                for ($year = $currentYear; $year >= 2000; $year--) {
                    $selected = $pengunjung->angkatan == $year ? 'selected' : '';
                    echo "<option value='$year' $selected>$year</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <select name="jurusan" required>
                <option value="">Pilih Jurusan</option>
                <option value="PPLG" {{ $pengunjung->jurusan == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                <option value="TJKT" {{ $pengunjung->jurusan == 'TJKT' ? 'selected' : '' }}>TJKT</option>
                <option value="DKV" {{ $pengunjung->jurusan == 'DKV' ? 'selected' : '' }}>DKV</option>
                <option value="AKL" {{ $pengunjung->jurusan == 'AKL' ? 'selected' : '' }}>AKL</option>
                <option value="ANIMASI" {{ $pengunjung->jurusan == 'ANIMASI' ? 'selected' : '' }}>ANIMASI</option>
                <option value="ULP" {{ $pengunjung->jurusan == 'ULP' ? 'selected' : '' }}>ULP</option>
                <option value="MPLB" {{ $pengunjung->jurusan == 'MPLB' ? 'selected' : '' }}>MPLB</option>
                <option value="PM" {{ $pengunjung->jurusan == 'PM' ? 'selected' : '' }}>PM</option>
            </select>
        </div>
        <div class="form-group">
            <label>Keluhan</label>
            <input type="text" name="keluhan" value="{{ $pengunjung->keluhan }}" required>
        </div>
        <div class="form-group">
            <label>Obat</label>
            <input type="text" name="terapi" value="{{ $pengunjung->terapi }}" required>
        </div>
        <button type="submit">Kirim</button>
    </form>
</div>
</body>
</html>
