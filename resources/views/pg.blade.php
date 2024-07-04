<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
        }
        .logout-container {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
        }
        .logout-container span {
            margin-right: 10px;
            font-size: 1rem;
            color: #333;
            margin-left: -10px;
            font-weight: bold; 
        }
        .logout {
            background-color: #ff6b6b;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-weight: bold;
        }
        .container {
            width: 50%;
            max-width: 500px;
            background: url('img/contact-form-bg.png') no-repeat center center;
            background-size: cover;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            margin-top: 50px;
        }
        .form-section {
            width: 100%;
        }
        .form-section h3 {
            font-size: 1.5rem;
            color: #333;
            text-align: center;
            font-weight: bold;
        }
        .form-section h3 span {
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 90%;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #00c4ff;
            background-color: transparent;
            outline: none;
            font-size: 0.9rem;
        }
        .form-group button {
            width: 50%; 
            padding: 10px;
            background-color: #ff6b6b;
            color: white;
            border: none;
            border-radius: 20px; 
            font-size: 1rem;
            margin: 0 auto; 
            font-weight: bold; 
        }
        .form-group button:hover {
            background-color: #e05555;
        }
        .services-right-dec, .services-left-dec {
            position: absolute;
        }
        .services-right-dec {
            top: 260px;
            right: 130px;
            width: 200px;
            height: 200px;
        }
        .services-left-dec {
            top: 20px;
            left: 0;
            width: 100px;
            height: 100px;
        }
        .table-container {
            width: 80%;
            max-width: 800px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
            font-family: 'Arial', sans-serif;
        }
        th {
            background-color: #ff6b6b;
            color: white;
            cursor: pointer;
            font-size: 1rem;
        }
        th.sortable:hover {
            background-color: #e05555;
        }
        td {
            font-size: 0.8rem;
        }
        .action-buttons button {
            background-color: #00c4ff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }
        .action-buttons button.edit {
            background-color: #00c4ff;
        }
        .action-buttons button.delete {
            background-color: #ff6b6b;
        }
        table {
            border-radius: 10px;
            overflow: hidden;
        }
        table, th, td {
            border: none;
        }
    </style>
</head>
<body>
    <div class="services-right-dec">
        <img src="img/services-right-dec.png" alt="">
    </div>
    <div class="services-left-dec">
        <img src="img/services-left-dec.png" alt="">
    </div>
    <div class="logout-container">
        <span>Warehouse</span>
        <button class="logout" onclick="window.location.href='/logout'">Logout</button>
    </div>
    <div class="container">
        <div class="form-section">
            <h3><span>Barang</span></h3>
            <form id="input-form" action="{{ url('petugasgudang') }}" method="get">
                <div class="form-group">
                    <input type="text" id="item-code" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci">
                </div>
                <div class="form-group">
                    <button type="submit">Cari</button>
                </div>
            </form>
            <div class="form-group">
                <a href="{{ url('petugasgudang/create') }}" class="btn btn-primary">+ Tambah Barang</a>
            </div>
        </div>
    </div>
    <div class="table-container">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <table id="product-table">
            <thead>
                <tr>
                    <th class="sortable" onclick="sortTable(0)">No</th>
                    <th class="sortable" onclick="sortTable(1)">Kode Barang</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Barcode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $data->firstItem() ?>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->KodeBarang }}</td>
                    <td>{{ $item->Nama }}</td>
                    <td>{{ $item->Satuan }}</td>
                    <td>{{ $item->HargaBeli }}</td>
                    <td>{{ $item->HargaJual }}</td>
                    <td>{{ $item->Stok }}</td>
                    <td>{{ $item->Barcode }}</td>
                    <td class="action-buttons">
                        <a href="{{ url('petugasgudang/'.$item->KodeBarang.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        <form class="d-inline" action="{{ url('petugasgudang/'.$item->KodeBarang) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Del</button>
                        </form>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("product-table");
            switching = true;
            dir = "asc"; 
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }

        // Push state untuk mendeteksi navigasi
        history.pushState(null, null, location.href);
        window.addEventListener('popstate', function(event) {
            // Mengarahkan ke /logout ketika tombol back di browser ditekan
            window.location.href = '/logout';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
