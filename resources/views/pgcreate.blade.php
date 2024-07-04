<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adding Stock</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            background-size: cover;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
        }
        .product-details, .input-stock {
            width: 45%;
        }
        .product-details h2, .input-stock h2 {
            color: #333;
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;  
        }
        .product-details h2 span, .input-stock h2 span {
            color: #00c4ff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #ffffff;
            font-size: 0.9rem; 
        }
        th {
            background-color: #ff6b6b;
            color: white;
            width: 30%;
            border-radius: 10px 0 0 10px; 
        }
        td {
            background-color: #ffffff;
            width: 70%;
            border-radius: 0 10px 10px 0; 
        }
        tr:nth-child(even) td {
            background-color: #f4f4f4; 
        }
        .input-stock {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-weight: bold;
        }
        .input-stock .quantity-controls {
            display: flex;
            align-items: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .input-stock .quantity-controls button {
            width: 40px;
            height: 40px;
            background-color: #00c4ff;
            color: black; 
            border: none;
            border-radius: 50%;
            margin: 0 5px; 
            font-size: 24px;
            cursor: pointer;
        }
        .input-stock .quantity-controls input {
            width: 100px;
            height: 40px;
            text-align: center;
            font-size: 24px;
            border: 2px solid #ccc;
            border-radius: 5px;
            background-color: transparent; 
            border: none; 
            box-shadow: none; 
            outline: none; 
        }
        .input-stock .submit-btn {
            padding: 10px 20px;
            background-color: #ff6b6b;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
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
        .services-right-dec, .services-left-dec {
            position: absolute;
        }
        .services-right-dec {
            top: 50px;
            left: 0;
            width: 80px;
            height: 80px;
        }
        .services-left-dec {
            top: 70px;
            right: 600px; 
            width: 150px;
            height: 150px;
        }
        .videos-left-dec {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            height: 100px;
        }
        .videos-right-dec {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="services-right-dec">
        <img src="img/videos-left-dec.png" alt="">
    </div>
    <div class="services-left-dec">
        <img src="img/videos-right-dec.png" alt="">
    </div>
    <div class="logout-container">
        <span>Warehouse</span>
        <button class="logout" onclick="window.location.href='/logout'">Logout</button>
    </div>
    <div class="container">
        <div class="product-details">
            <h2>Product <span>Details</span></h2>
            <form action='{{ url('barang') }}' method='post'>
            @csrf
                <table>
                    <tr>
                        <th>Kode Barang</th>
                        <td><input type="text" name="KodeBarang" value="{{ Session::get('KodeBarang') }}" required></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><input type="text" name="Nama" value="{{ Session::get('Nama') }}"></td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td><input type="text" name="Satuan" value="{{ Session::get('Satuan') }}"></td>
                    </tr>
                    <tr>
                        <th>Harga Beli</th>
                        <td><input type="number" step="0.01" name="HargaBeli" value="{{ Session::get('HargaBeli') }}" min="0"></td>
                    </tr>
                    <tr>
                        <th>Harga Jual</th>
                        <td><input type="number" step="0.01" name="HargaJual" value="{{ Session::get('HargaJual') }}" min="0"></td>
                    </tr>
                    <tr>
                        <th>Barcode</th>
                        <td><input type="number" name="Barcode" value="{{ Session::get('Barcode') }}" min="0"></td>
                    </tr>
                </table>
        </div>
        <div class="input-stock">
            <h2><span>Input</span> Stock</h2> 
            <div class="quantity-controls">
                <button type="button" id="decrease-btn">-</button>
                <input type="number" name="Stok" id="quantity" value="0" min="0">
                <button type="button" id="increase-btn">+</button>
            </div>
            <button type="submit" class="submit-btn">+ Tambah Barang</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('increase-btn').addEventListener('click', () => {
            let quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });

        document.getElementById('decrease-btn').addEventListener('click', () => {
            let quantityInput = document.getElementById('quantity');
            if (quantityInput.value > 0) quantityInput.value = parseInt(quantityInput.value) - 1;
        });

        // Push state untuk mendeteksi navigasi
        history.pushState(null, null, location.href);
        window.addEventListener('popstate', function(event) {
          // Mengarahkan ke /logout ketika tombol back di browser ditekan
          window.location.href = '/logout';
        });
    </script>
</body>
</html>
