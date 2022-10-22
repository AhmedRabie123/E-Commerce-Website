<!DOCTYPE html>
<html>

<head>
    {{-- <base href="/public"> This code is in the event that there is a mistake in the design, so I write it to correct the shape in the event that I do not write the asset --}}

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
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('Front.header')
        <!-- end header section -->

        {{-- if for message success --}}
        @if (session()->has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('success') }}
            </div>
        @endif

        {{-- product detail started --}}

        <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width:50%; padding: 30px;">
            <div class="box">

                <div class="img-box" style="padding: 20px;">
                    <img src="{{ asset('images/' . $product->image) }}" alt="">
                </div>
                <div class="detail-box">
                    <h5>
                        {{ $product->title }}
                    </h5>

                    @if ($product->discount_price != null)
                        <h6 style="color: red;">
                            سعر الخصم
                            <br>
                            E£{{ $product->discount_price }}
                        </h6>

                        <h6 style="text-decoration: line-through; color:blue;">
                            السعر
                            <br>
                            E£{{ $product->price }}
                        </h6>
                    @else
                        <h6 style="color: blue;">
                            السعر
                            <br>
                            E£{{ $product->price }}
                        </h6>
                    @endif

                    <h6>
                        <span style="color: red;">الفئه :</span> {{ $product->rCategory->category_name }}
                    </h6>

                    <h6>
                        <span style="color: red;">تفاصيل المنتج :</span> {{ $product->description }}
                    </h6>

                    <h6>
                        <span style="color: red;">الكميه المتوفره :</span> {{ $product->quantity }}
                    </h6>

                    <form action="{{ route('add_cart', $product->id) }}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-md-4">
                                <input type="number" name="quantity" value="1" min="1"
                                    style="width: 100px; ">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" value="أضف إلى السلة">
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- product detail ended --}}

        <!-- footer start -->
        @include('Front.footer')
        <!-- footer end -->
        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

                Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

            </p>
        </div>
        <!-- jQery -->
        <script src="{{ asset('front/js/jquery-3.4.1.min.js') }}"></script>
        <!-- popper js -->
        <script src="{{ asset('front/js/popper.min.js') }}"></script>
        <!-- bootstrap js -->
        <script src="{{ asset('front/js/bootstrap.js') }}"></script>
        <!-- custom js -->
        <script src="{{ asset('front/js/custom.js') }}"></script>
</body>

</html>
