<!DOCTYPE html>
<html>

<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('front/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>


<body>

    @include('sweetalert::alert')

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
 

        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="font-size: 25px; text-align:center; padding-bottom:15px;">{{ $about->about_title }}</h2>
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href=""></a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $about->about_title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       {!! $about->about_detail !!}
                    </div>
                </div>
            </div>
        </div>







  
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
