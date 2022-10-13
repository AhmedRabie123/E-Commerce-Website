<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="front/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="front/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="front/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="front/css/responsive.css" rel="stylesheet" />
</head>

<body>

    <div class="hero_area">
 
        {{-- if for message success --}}
        @if (session()->has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('success') }}
            </div>
        @endif

        <!-- header section strats -->
        @include('Front.header')
        <!-- end header section -->
        <!-- slider section -->
        @include('Front.slider')
        <!-- end slider section -->
    </div>
    <!-- why section -->
    @include('Front.why')
    <!-- end why section -->

    <!-- arrival section -->
    @include('Front.new_arrival')
    <!-- end arrival section -->

    <!-- product section -->
    @include('Front.product')
    <!-- end product section -->

    <!-- subscribe section -->
    @include('Front.subscribe')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('Front.client')
    <!-- end client section -->
    <!-- footer start -->
    @include('Front.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto"><a href="https://web.facebook.com/ahmed.rabea.10048/">Ahmed Rabie</a> جميع الحقوق محفوظه لدي
            © 2021<br>

            وزعت من خلال <a href="https://themewagon.com/" target="_blank">Ahmed Rabie</a>

        </p>
    </div>
    <!-- jQery -->
    <script src="front/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="front/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="front/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="front/js/custom.js"></script>
</body>

</html>
