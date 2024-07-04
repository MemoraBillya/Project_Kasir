<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Admin</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/template.css">
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
        .sortable:hover {
            cursor: pointer;
            text-decoration: underline;
        }
        .nacc ul {
            padding: 0;
            list-style: none;
        }
        .nacc li {
            display: none;
        }
        .nacc li.active {
            display: block;
        }
        .menu div {
            cursor: pointer;
        }
        .chart-container {
            position: relative;
            height: 400px; /* Increase height */
            width: 100%; /* Increase width */
            margin: 20px auto;
        }
        .chart-heading {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 20px;
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

<div id="video" class="our-videos section">
    <div class="videos-left-dec">
        <img src="images/videos-left-dec.png" alt="">
    </div>
    <div class="videos-right-dec">
        <img src="images/videos-right-dec.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="section-heading">
                <h2><span>Data</span> Records</h2>
            </div>
            <div class="col-lg-12">
                <div class="naccs">
                    <div class="grid">
                        <div class="row">
                            <div class="col-lg-8">
                                <ul class="nacc">
                                    <li class="active">
                                        <div>
                                            <div class="thumb">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Keterangan</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Total Produk</td>
                                                            <td>{{ $totalProduk }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Order</td>
                                                            <td>{{ $totalOrder }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="thumb">
                                                <table id="barang-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Kode Barang</th>
                                                            <th>Nama</th>
                                                            <th>Satuan</th>
                                                            <th class="sortable" onclick="sortTable(3, 'barang-table')">Harga Beli</th>
                                                            <th class="sortable" onclick="sortTable(3, 'barang-table')">Harga Jual</th>
                                                            <th class="sortable" onclick="sortTable(4, 'barang-table')">Stok</th>
                                                            <th>Barcode</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($barangs as $barang)
                                                        <tr>
                                                            <td>{{ $barang->KodeBarang }}</td>
                                                            <td>{{ $barang->Nama }}</td>
                                                            <td>{{ $barang->Satuan }}</td>
                                                            <td>{{ $barang->HargaBeli }}</td>
                                                            <td>{{ $barang->HargaJual }}</td>
                                                            <td>{{ $barang->Stok }}</td>
                                                            <td>{{ $barang->Barcode }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <div class="thumb">
                                                <table id="orders-table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID Order</th>
                                                            <th>User ID</th>
                                                            <th class="sortable" onclick="sortTable(2, 'orders-table')">Total Harga</th>
                                                            <th class="sortable" onclick="sortTable(3, 'orders-table')">Tanggal Order</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="orders-table-body">
                                                        @foreach($orders as $order)
                                                        <tr>
                                                            <td>{{ $order->id }}</td>
                                                            <td>{{ $order->user_id }}</td>
                                                            <td>{{ $order->total_harga }}</td>
                                                            <td>{{ $order->tanggal_order }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <div class="menu">
                                    <div class="active" onclick="switchTab(0)">
                                        <div class="thumb">
                                            <img src="images/video-thumb-01.png" alt="">
                                            <div class="inner-content">
                                                <h4>Table 1</h4>
                                                <span>Summary</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div onclick="switchTab(1)">
                                        <div class="thumb">
                                            <img src="images/video-thumb-02.png" alt="">
                                            <div class="inner-content">
                                                <h4>Table 2</h4>
                                                <span>Product Stock</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div onclick="switchTab(2)">
                                        <div class="thumb">
                                            <img src="images/video-thumb-03.png" alt="">
                                            <div class="inner-content">
                                                <h4>Table 3</h4>
                                                <span>Transaction Details</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                            </div>             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="pricing" class="pricing-tables">
    <div class="tables-left-dec">
        <img src="images/tables-left-dec.png" alt="">
    </div>
    <div class="tables-right-dec">
        <img src="images/tables-right-dec.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading">
                    <h2>Data <span>Statistic</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="item first-item chart-container">
                    <h4 class="chart-heading">Product Stock</h4>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="item second-item chart-container">
                    <h4 class="chart-heading">Stok vs Harga Jual</h4>
                    <canvas id="scatterChart"></canvas>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="item third-item chart-container">
                    <h4 class="chart-heading">Transaction Details</h4>
                    <canvas id="histogramChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/owl-carousel.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function sortTable(columnIndex, tableId) {
        const table = document.getElementById(tableId);
        const tbody = table.getElementsByTagName('tbody')[0];
        const rows = Array.from(tbody.getElementsByTagName('tr'));

        const sortedRows = rows.sort((a, b) => {
            const cellA = a.getElementsByTagName('td')[columnIndex].innerText.toLowerCase();
            const cellB = b.getElementsByTagName('td')[columnIndex].innerText.toLowerCase();

            if (columnIndex === 2 || columnIndex === 3 || columnIndex === 4) { // Adjusted column index for price and stock
                return parseFloat(cellA.replace(/[^\d.-]/g, '')) - parseFloat(cellB.replace(/[^\d.-]/g, ''));
            } else {
                return cellA.localeCompare(cellB);
            }
        });

        tbody.innerHTML = '';
        sortedRows.forEach(row => tbody.appendChild(row));
    }

    function updateCharts(data) {
        // Update Bar Chart for Stock Levels
        barChart.data.labels = data.barangLabels;
        barChart.data.datasets[0].data = data.stokData;
        barChart.update();

        // Update Scatter Chart for Stok vs Harga Jual
        scatterChart.data.datasets[0].data = data.stokVsHargaData;
        scatterChart.update();

        // Update Histogram Chart for Total Harga
        histogramChart.data.labels = data.orderLabels;
        histogramChart.data.datasets[0].data = data.totalHargaData;
        histogramChart.update();
    }

    function fetchData() {
        $.ajax({
            url: '/get-chart-data',
            method: 'GET',
            success: function(data) {
                updateCharts(data);
            },
            error: function(error) {
                console.log('Error fetching data:', error);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize charts
        var barCtx = document.getElementById('barChart').getContext('2d');
        barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: [], // Initial empty data
                datasets: [{
                    label: 'Stok',
                    data: [],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 18
                            }
                        }
                    }
                }
            }
        });

        var scatterCtx = document.getElementById('scatterChart').getContext('2d');
        scatterChart = new Chart(scatterCtx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Stok vs Harga Jual',
                    data: [],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        title: {
                            display: true,
                            text: 'Stok',
                            font: {
                                size: 18
                            }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Harga Jual',
                            font: {
                                size: 18
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 18
                            }
                        }
                    }
                }
            }
        });

        var histogramCtx = document.getElementById('histogramChart').getContext('2d');
        histogramChart = new Chart(histogramCtx, {
            type: 'bar',
            data: {
                labels: [], // Initial empty data
                datasets: [{
                    label: 'Total Harga',
                    data: [],
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 18
                            }
                        }
                    }
                }
            }
        });

        // Fetch initial data and set interval for updates
        fetchData();
        setInterval(fetchData, 60000); // Fetch data every 60 seconds
    });

    $(document).on("click", ".naccs .menu div", function() {
        var numberIndex = $(this).index();

        if (!$(this).is("active")) {
            $(".naccs .menu div").removeClass("active");
            $(".naccs ul li").removeClass("active");

            $(this).addClass("active");
            $(".naccs ul").find("li:eq(" + numberIndex + ")").addClass("active");

            var listItemHeight = $(".naccs ul")
                .find("li:eq(" + numberIndex + ")")
                .innerHeight();
            $(".naccs ul").height(listItemHeight + "px");
        }
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
