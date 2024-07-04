<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Kasir</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/animated.css">
    <style>
        .hidden {
            display: none;
        }
        .input-us.section, .col-l-12 {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 10vh;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 960px;
        }
    </style>
</head>

<body>
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#contact">On Duty: {{ Auth::user()->name }}</a></li>
                            <li class="scroll-to-section">
                                <div class="main-red-button-hover"><a href="/logout">Logout</a></div>
                            </li>
                        </ul>
                        <a class='menu-trigger'><span>Menu</span></a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="container my-3">
        <h1>Hello</h1>
        <div class="card mt-3">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Order Here</li>
            </ul>
        </div>
    </div>
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <div id="contact" class="input-us section">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-6">
                  <form id="contact-form" method="" action="" onsubmit="addItem(event)">
                      @csrf
                      <div class="form-group">
                          <label for="kode_barang">Nama Barang:</label>
                          <select name="kode_barang" id="kode_barang" class="form-control" onchange="updateDetails()">
                              <option value="">Pilih Barang</option>
                              @foreach ($barangs as $barang)
                                  <option value="{{ $barang->KodeBarang }}">{{ $barang->Nama }}</option>
                              @endforeach
                          </select>
                      </div>
  
                      <div class="form-group">
                          <label for="stok">Stok:</label>
                          <input type="text" id="stok" class="form-control" placeholder="Stok" readonly>
                      </div>
  
                      <div class="form-group">
                          <label for="harga_jual">Harga Jual:</label>
                          <input type="text" id="harga_jual" class="form-control" placeholder="Harga Jual" readonly>
                      </div>
  
                      <div class="form-group">
                          <label for="quantity">Quantity:</label>
                          <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity" required>
                      </div>
  
                      <div class="form-group button-container text-centre">
                        <button type="submit" id = "form-submit" class="main-button mt-3">Add Product</button>
                        {{-- <button type="submit" id="form-submit" class="main-button">Cancel</button> --}}
                    </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

    <div class="col-l-12">
        <div class="cashier-details">
            <div class="flex-container2">
                <div class="table-container2">
                    <table>
                        <thead>
                            <tr>
                                <th class="name">Product Name</th>
                                <th class="quantity">Quantity</th>
                                <th class="price">Each Price</th>
                                <th class="price">Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="item-table">
                            <!-- Table rows will be inserted here dynamically -->
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="3">Total</td>
                                <td id="total-price" data-total="0">Rp0,00</td>
                            </tr>
                            <tr>
                                <td colspan="3">Cash</td>
                                <td>
                                    <input type="number" id="cash" placeholder="Input amount" onchange="calculateChange()">
                                </td> 
                            </tr>
                            <tr>
                                <td colspan="3">Change</td>
                                <td id="change">Rp0,00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="button-container">
                    <form action="{{ url('kasir') }}" method="get">
                        <button type="submit" id="form-submit" class="main-button">Cancel</button>
                    </form>
                    <form id="process-form" action="{{ url('kasir/order') }}" method="post" onsubmit="processOrder(event)">
                        @csrf
                        <button type="submit" id="form-submit" class="main-button">Process</button>
                        <input type="hidden" name="total_harga" id="hidden-total-harga">
                    </form>
                    <div class="pb-3">
                      <a href='{{ url('kasir/order') }}' class="btn btn-primary">Kumpulan Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    

    <script>
        function formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 2
            }).format(value).replace(/,00$/, ',00');
        }

        function toggleCustomAmountInput() {
            const cashSelect = document.getElementById('cash');
            const customAmountInput = document.getElementById('custom-amount');

            if (cashSelect.value === 'custom') {
                customAmountInput.classList.remove('hidden');
                customAmountInput.focus();
                customAmountInput.addEventListener('input', calculateChange);
            } else {
                customAmountInput.classList.add('hidden');
                customAmountInput.removeEventListener('input', calculateChange);
                calculateChange();
            }
        }

        function calculateChange() {
            const totalPriceElement = document.getElementById('total-price');
            const total = parseFloat(totalPriceElement.getAttribute('data-total') || '0');
            const cashSelect = document.getElementById('cash');
            const customAmountInput = document.getElementById('custom-amount');
            let cash = parseFloat(cashSelect.value);

            if (cashSelect.value === 'custom') {
                cash = parseFloat(customAmountInput.value) || 0;
            }

            const change = cash - total;
            document.getElementById('change').innerText = formatCurrency(change);
        }

        function addItem(event) {
            event.preventDefault();
            const productName = document.getElementById('kode_barang').options[document.getElementById('kode_barang').selectedIndex].text;
            const quantity = parseInt(document.getElementById('quantity').value);
            const price = parseFloat(document.getElementById('harga_jual').value);
            const table = document.getElementById('item-table');
            const totalPriceElement = document.getElementById('total-price');
            let totalPrice = parseFloat(totalPriceElement.getAttribute('data-total') || '0');

            if (productName && quantity && price) {
                const row = document.createElement('tr');
                const itemTotalPrice = quantity * price;
                row.innerHTML = `
                    <td>${productName}</td>
                    <td>${quantity}</td>
                    <td>${formatCurrency(price)}</td>
                    <td>${formatCurrency(itemTotalPrice)}</td>
                `;
                table.appendChild(row);

                totalPrice += itemTotalPrice;
                totalPriceElement.setAttribute('data-total', totalPrice);
                totalPriceElement.innerText = formatCurrency(totalPrice);

                document.getElementById('contact-form').reset();
            } else {
                alert('Harap isi semua kolom.');
            }
        }

        function updateDetails() {
            const kodeBarang = document.getElementById('kode_barang').value;
            if (!kodeBarang) {
                document.getElementById('stok').value = '';
                document.getElementById('harga_jual').value = '';
                return;
            }
            fetch(`/kasir?kode_barang=${kodeBarang}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('stok').value = data.stok;
                    document.getElementById('harga_jual').value = data.harga_jual;
                })
                .catch(error => console.error('Error:', error));
        }

        function processOrder(event) {
    event.preventDefault();
    const change = parseFloat(document.getElementById('change').innerText.replace(/[^\d.-]/g, ''));

    if (change < 0) {
        alert('Saldo Kurang');
        return; // Stop processing the order
    } else {
        const total = parseFloat(document.getElementById('total-price').getAttribute('data-total'));
        const items = [];
        document.querySelectorAll('#item-table tr').forEach(row => {
            const cells = row.getElementsByTagName('td');
            if (cells.length > 0) {
                items.push({
                    kode_barang: cells[0].innerText,
                    quantity: parseInt(cells[1].innerText),
                    item_total_price: parseFloat(cells[3].innerText.replace(/[^\d,.-]/g, '').replace(',', '.'))
                });
            }
        });

        const data = {
            _token: document.querySelector('input[name="_token"]').value,
            total_harga: total,
            items: items
        };

        console.log('Data to send:', data); // Log data before sending

        fetch('{{ url('kasir/order') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response data:', data); // Log response data
            if (data.success) {
                alert('Order berhasil ditambahkan');
                window.location.reload();
            } else {
                alert('Terjadi kesalahan, silakan coba lagi');
                if (data.errors) {
                    console.log('Validation errors:', data.errors);
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada jaringan, silakan coba lagi');
        });
    }
}





        // function processOrder(event) {
        //   event.preventDefault();
        //   const items = [];
        //   const table = document.getElementById('item-table');

        //   Array.from(table.rows).forEach(row => {
        //       const item = {
        //           nama_barang: row.cells[0].innerText,
        //           quantity: parseInt(row.cells[1].innerText),
        //           harga_jual: parseFloat(row.cells[2].innerText.replace(/[^\d.-]/g, ''))
        //       };
        //       items.push(item);
        //   });

        //   const data = {
        //       _token: document.querySelector('input[name="_token"]').value,
        //       total_harga: parseFloat(document.getElementById('total-price').getAttribute('data-total')),
        //       items: items
        //   };

        //   fetch('{{ url('kasir/order') }}', {
        //       method: 'POST',
        //       headers: {
        //           'Content-Type': 'application/json',
        //           'X-Requested-With': 'XMLHttpRequest'
        //       },
        //       body: JSON.stringify(data)
        //   })
        //   .then(response => response.json())
        //   .then(data => {
        //       if (data.success) {
        //           alert('Order berhasil ditambahkan');
        //           window.location.reload();
        //       } else {
        //           alert('Terjadi kesalahan, silakan coba lagi');
        //       }
        //   })
        //   .catch(error => console.error('Error:', error));
        // }
    </script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl-carousel.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
    <script>
      // Push state untuk mendeteksi navigasi
      history.pushState(null, null, location.href);
      window.addEventListener('popstate', function(event) {
        // Mengarahkan ke /logout ketika tombol back di browser ditekan
        window.location.href = '/logout';
      });
    </script>
</body>

</html>
