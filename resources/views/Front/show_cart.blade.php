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

    <style>
        .center {
            margin: auto;
            width: 70%;
            text-align: center;
            padding: 30px;
        }

        table,
        th,
        td {
            border: 1px solid grey;
        }

        .th_deg {
            font-size: 20px;
            padding: 5px;
            background: skyblue;
        }

        .img_deg {
            height: 100px;
            width: 100px;
        }

        .total_deg {
            font-size: 20px;
            padding: 40px;
        }

        span {
            color: red;
        }
    </style>

</head>

<body>

    <div class="hero_area">

        <!-- header section strats -->
        @include('Front.header')
        <!-- end header section -->
        <!-- slider section -->

        {{-- if for message success --}}
        @if (session()->has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('success') }}
            </div>
        @endif

        <!-- end slider section -->

        <!-- cart section -->

        <div class="center">
            <table>
                <thead>
                    <tr>
                        <th class="th_deg" style="width: 160px;">صورة المنتج</th>
                        <th class="th_deg" style="width: 150px;">عنوان المنتج</th>
                        <th class="th_deg" style="width: 150px;">كمية المنتج</th>
                        <th class="th_deg" style="width: 90px;">السعر</th>
                        <th class="th_deg" style="width: 150px;">حذف</th>
                        <th class="th_deg" style="width: 180px;">عرض المنتج</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $total_price = 0;
                    @endphp

                    @foreach ($cart as $item)
                        <tr>
                            <td class="img_deg">
                                <img src="{{ asset('images/' . $item->image) }}" alt="">
                            </td>
                            <td>{{ $item->product_title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>E£ {{ $item->price }}</td>
                            <td><a class="btn btn-danger" onClick="return confirm('هل أنت متأكد من حذف هذا المنتج؟');"
                                    href="{{ route('remove_cart', $item->id) }}">إزالة المنتج</a></td>
                            <td><a class="btn btn-info" href="{{ route('product_detail', $item->rProduct->id) }}">الذهاب الي
                                    المنتج</a></td>
                        </tr>

                        @php
                            $total_price = $total_price + $item->price;
                        @endphp
                    @endforeach

                </tbody>
            </table>
            <div>
                <h1 class="total_deg"> E£ {{ $total_price }} <span>: المجموع الكلي</span></h1>
            </div>

            <div>
                <h1 style="font-size: 25px; padding-bottom: 15px;">تابع الطلب</h1>
                <a class="btn btn-danger" href="{{ route('cash_order') }}">الدفع عند الاستلام</a>
                <a class="btn btn-danger" href="{{ route('stripe', $total_price) }}">الدفع باستخدام البطاقة</a>
            </div>
        </div>

        <!-- End cart section -->

        <!-- footer start -->
        {{-- @include('Front.footer') --}}
        <!-- footer end -->
        <div class="cpy_">
            <p class="mx-auto"><a href="https://web.facebook.com/ahmed.rabea.10048/">Ahmed Rabie</a> جميع الحقوق محفوظه
                لدي
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
