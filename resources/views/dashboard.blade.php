<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Dashboard</title>

        <link
            href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap"
            rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

        <style>
            * {
                font-family: 'Quicksand', sans-serif;
                box-sizing: border-box;
            }
            body,
            html {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            body {
                background: url("images/7283494.jpg") no-repeat center center fixed;
                background-size: cover;
            }
            .overlay {
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                background-color: rgba(255, 255, 255, 0.35);
                min-height: 100vh;
                padding: 60px 40px;
            }
            .container {
                max-width: 1300px;
                margin: auto;
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 12px;
                padding: 30px;
            }
            h2 {
                margin-bottom: 20px;
            }
            a {
                text-decoration: none;
            }
            .filter-bar {
                background-color: #cfe2ff;
                padding: 15px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
                margin-bottom: 15px;
            }
            .filter-bar input[type="text"],
            .filter-bar input[type="date"],
            .filter-bar button,
            .filter-bar select {
                padding: 8px 12px;
                font-size: 13px;
                border: 1px solid #ced4da;
                border-radius: 4px;
            }
            .add-btn,
            .home-btn {
                background-color: #6f42c1;
                color: white;
                padding: 8px;
                border-radius: 50%;
                font-weight: bold;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                height: 25px;
                width: 25px;
            }
            .search-group {
                position: relative;
                margin-left: auto;
            }
            .search-input {
                padding: 8px 35px 8px 12px;
                width: 250px;
            }
            .search-btn {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                cursor: pointer;
                color: #6c757d;
            }
            .confirm-btn {
                background-color: #28a745;
                color: white;
                padding: 8px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
            }
            .reset-btn {
                background-color: #dc3545;
                color: white;
                padding: 8px 15px;
                border-radius: 4px;
                text-decoration: none;
                font-size: 14px;
            }
            .print-btn {
                background-color: #0d6efd;
                color: white;
                padding: 8px 15px;
                border-radius: 4px;
                border: none;
                font-size: 14px;
                cursor: pointer;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 13px;
            }
            table td,
            table th {
                border: 1px solid #ccc;
                padding: 6px 10px;
                text-align: left;
            }
            table thead tr {
                background-color: #f0f0f0;
            }
            .btn-edit {
                background-color: orange;
                color: white;
                padding: 4px 8px;
                font-size: 12px;
                border-radius: 5px;
            }
            .btn-delete {
                background-color: red;
                color: white;
                padding: 4px 8px;
                font-size: 12px;
                border-radius: 5px;
                border: none;
            }

            /* Modal styles */
            .modal {
                display: none;
                position: fixed;
                z-index: 10;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.5);
            }
            .modal-content {
                background-color: #fff;
                margin: 15% auto;
                padding: 20px;
                border-radius: 10px;
                width: 300px;
                text-align: center;
            }
            .modal-content button {
                margin: 10px;
                padding: 8px 16px;
                font-size: 14px;
                border-radius: 6px;
                border: none;
                cursor: pointer;
            }
            .btn-excel {
                background-color: #2a6099;
                color: white;
            }
            .btn-pdf {
                background-color: #198754;
                color: white;
            }
            .close-modal {
                color: #aaa;
                float: right;
                font-size: 20px;
                cursor: pointer;
            }

            @media print {
                body {
                    background: white !important;
                }
                .overlay {
                    background: white !important;
                    backdrop-filter: none !important;
                    padding: 0;
                }
                .btn-delete,
                .btn-edit,
                .filter-bar,
                .print-btn,
                form {
                    display: none !important;
                }
                .container {
                    padding: 0;
                    background: none;
                }
                table {
                    font-size: 12px;
                }
                table td,
                table th {
                    border: 1px solid #000;
                    padding: 6px;
                }
            }
            @media (max-width: 768px) {
                .filter-bar {
                    flex-direction: column;
                    align-items: stretch;
                }
                .search-group {
                    margin-left: 0;
                    width: 100%;
                }
                .search-input {
                    width: 100%;
                }
                .confirm-btn,
                .print-btn,
                .reset-btn {
                    width: 100%;
                    margin: 5px 0;
                }
            }
        </style>
    </head>
    <body>
        <div class="overlay">
            <div class="container">
                <h2>
                    <strong>Dashboard</strong>
                </h2>

                <form
                    method="GET"
                    action="{{ route('dashboard') }}"
                    class="filter-bar"
                    id="filterForm">
                    <a href="{{ route('home') }}" class="home-btn">«</a>
                    <a href="{{ route('pengunjung.create') }}" class="add-btn">+</a>

                    <select name="angkatan">
                        <option value="">Semua Angkatan</option>
                        @foreach($angkatans as $angkatan)
                        <option
                            value="{{ $angkatan }}"
                            {{ request('angkatan') == $angkatan ? 'selected' : '' }}>{{ $angkatan }}</option>
                        @endforeach
                    </select>

                    <select name="jurusan">
                        <option value="">Semua Jurusan</option>
                        <option value="PPLG" {{ request('jurusan') == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                        <option value="TJKT" {{ request('jurusan') == 'TJKT' ? 'selected' : '' }}>TJKT</option>
                        <option value="DKV" {{ request('jurusan') == 'DKV' ? 'selected' : '' }}>DKV</option>
                        <option value="AKL" {{ request('jurusan') == 'AKL' ? 'selected' : '' }}>AKL</option>
                        <option value="ANIMASI" {{ request('jurusan') == 'ANIMASI' ? 'selected' : '' }}>ANIMASI</option>
                        <option value="ULP" {{ request('jurusan') == 'ULP' ? 'selected' : '' }}>ULP</option>
                        <option value="MPLB" {{ request('jurusan') == 'MPLB' ? 'selected' : '' }}>MPLB</option>
                        <option value="PM" {{ request('jurusan') == 'PM' ? 'selected' : '' }}>PM</option>
                    </select>

                    <select name="kelas">
                        <option value="">Semua Kelas</option>
                        <option value="10" {{ request('kelas') == '10' ? 'selected' : '' }}>10</option>
                        <option value="11" {{ request('kelas') == '11' ? 'selected' : '' }}>11</option>
                        <option value="12" {{ request('kelas') == '12' ? 'selected' : '' }}>12</option>
                    </select>

                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"/>

                    <div class="search-group">
                        <input
                            type="text"
                            name="search"
                            placeholder="Cari nama/keluhan/obat..."
                            class="search-input"
                            value="{{ request('search') }}"/>
                        <button
                            type="button"
                            class="search-btn"
                            onclick="document.getElementById('filterForm').submit()">
                            🔍
                        </button>
                    </div>

                    <button type="submit" class="confirm-btn">Terapkan Filter</button>
                    <a href="{{ route('dashboard') }}" class="reset-btn">Reset</a>
                    <button type="button" class="print-btn" onclick="openModal()">Print</button>
                </form>

                <table id="exportTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Hari/Tanggal</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Angkatan</th>
                            <th>Jurusan</th>
                            <th>Keluhan</th>
                            <th>Obat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengunjungs as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->angkatan }}</td>
                            <td>{{ $item->jurusan }}</td>
                            <td>{{ $item->keluhan }}</td>
                            <td>{{ $item->terapi }}</td>
                            <td>
                                <a href="{{ route('pengunjung.edit', $item->id_pengunjung) }}" class="btn-edit">EDIT</a>
                                <form
                                    action="{{ route('pengunjung.destroy', $item->id_pengunjung) }}"
                                    method="POST"
                                    style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin hapus?')"
                                        class="btn-delete">DELETE</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div id="printModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal()">&times;</span>
                <h4>Pilih Format</h4>
                <button class="btn-excel" onclick="exportToExcel()">📊 Excel</button>
                <button class="btn-pdf" onclick="printTable()">🖨️ PDF</button>
            </div>
        </div>

        <script>
            function openModal() {
                document
                    .getElementById('printModal')
                    .style
                    .display = 'block';
            }

            function closeModal() {
                document
                    .getElementById('printModal')
                    .style
                    .display = 'none';
            }

            window.onclick = function (event) {
                if (event.target == document.getElementById('printModal')) {
                    closeModal();
                }
            }

            function exportToExcel() {
                const table = document.getElementById('exportTable');
                const cloneTable = table.cloneNode(true);
                const actionColIndex = 8;
                const rows = cloneTable.getElementsByTagName('tr');
                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    if (cells.length > actionColIndex) {
                        rows[i].deleteCell(actionColIndex);
                    }
                }
                const headerRow = cloneTable.getElementsByTagName('tr')[0];
                if (headerRow) 
                    headerRow.deleteCell(actionColIndex);
                
                const wb = XLSX
                    .utils
                    .table_to_book(cloneTable, {sheet: "Sheet1"});
                const today = new Date();
                const dateString = today
                    .toISOString()
                    .split('T')[0];
                XLSX.writeFile(wb, `Data_Pengunjung_${dateString}.xlsx`);
                closeModal();
            }
            function printTable() {
                // Clone and modify the table like in exportToExcel()
                const table = document.getElementById('exportTable');
                const cloneTable = table.cloneNode(true);
                const actionColIndex = 8;
                const rows = cloneTable.getElementsByTagName('tr');

                // Remove Aksi column
                for (let i = 0; i < rows.length; i++) {
                    const cells = rows[i].getElementsByTagName('td');
                    if (cells.length > actionColIndex) {
                        rows[i].deleteCell(actionColIndex);
                    }
                }
                const headerRow = cloneTable.getElementsByTagName('tr')[0];
                if (headerRow) 
                    headerRow.deleteCell(actionColIndex);
                
                // Replace original table with modified clone
                const originalParent = table.parentNode;
                originalParent.replaceChild(cloneTable, table);

                closeModal();

                // Print after a small delay to ensure DOM updates
                setTimeout(() => {
                    window.print();

                    // Restore original table after printing
                    originalParent.replaceChild(table, cloneTable);
                }, 300);
            }
        </script>
    </body>
</html>