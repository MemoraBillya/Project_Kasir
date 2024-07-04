<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Kasir | Order</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animated.css') }}">
</head>
<body>
    <div class="container my-3">
        <h1>Order Table</h1>
    </div>
    <div class="container my-3">
        <div class="col-lg-12">
            <div class="cashier-details">
                <div class="flex-container2">
                    <div class="table-container2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="name">Order ID</th>
                                    <th class="name">User ID</th>
                                    <th class="price">Total Harga</th>
                                    <th class="date">Tanggal Order</th>
                                </tr>
                            </thead>
                            <tbody id="order-table">
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user_id }}</td>
                                        <td>Rp{{ number_format($order->total_harga, 2, ',', '.') }}</td>
                                        <td>{{ $order->tanggal_order }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="button-container">
        <a href="{{ url('kasir') }}" id="form-submit" class="main-button mt-3 btn btn-primary">Back</a>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/isotope.min.js') }}"></script>
    <script src="{{ asset('js/owl-carousel.js') }}"></script>
    <script src="{{ asset('js/counter.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
