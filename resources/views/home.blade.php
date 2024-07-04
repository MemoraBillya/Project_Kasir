<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Home</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animated.css') }}">
</head>

<body>

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

    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <ul class="nav">
                            <li class="scroll-to-section">
                                <div class="main-red-button-hover">
                                    <a href="{{ route('login') }}">Login</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="owl-carousel owl-banner">
                                <div class="item header-text">
                                    <h6>Welcome to Cashier Website</h6>
                                    <h2>Build <em>your data management</em> the best in <span>CONTROL!</span></h2>
                                    <p>This is a professional website that allows Admins to access and manage all data, including income, expenses, and more.</p>
                                </div>
                                <div class="item header-text">
                                    <h6>Welcome to Cashier Website</h6>
                                    <h2>Get the <em>best inventory</em> managements <span>for your needs!</span></h2>
                                    <p>This website enables Warehouse Staff to input and check stock data manually or via barcode scanning, ensuring efficient stock management.</p>
                                </div>
                                <div class="item header-text">
                                    <h6>Welcome to Cashier Website</h6>
                                    <h2>Enhance <em>your sale process</em> with <span>efficiency!</span></h2>
                                    <p>Our website helps Cashiers with sales transaction processes, including manual input or barcode scanning of sold items, and printing receipts for customers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl-carousel.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        $(document).on("click", ".naccs .menu div", function() {
            var numberIndex = $(this).index();

            if (!$(this).hasClass("active")) {
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
    </script>
</body>
</html>
