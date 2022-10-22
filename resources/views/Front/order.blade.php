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

    <style>
        .center {
            margin: auto;
            width: 85%;
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
            background: rgb(160, 130, 187);
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

    <h1 style="font-size: 25px; text-align: center; font-weight: bold;"> All Orders</h1>


    <div class="center">
        <table>
            <thead>
                <tr>
                    <th class="th_deg" style="width: 160px;">صورة المنتج</th>
                    <th class="th_deg" style="width: 120px;">عنوان المنتج</th>
                    <th class="th_deg" style="width: 120px;">كمية المنتج</th>
                    <th class="th_deg" style="width: 90px;">السعر</th>
                    <th class="th_deg" style="width: 120px;">حالة السداد</th>
                    <th class="th_deg" style="width: 120px;">حالة التسليم</th>
                    <th class="th_deg" style="width: 110px;">حذف</th>
                    <th class="th_deg" style="width: 180px;">عرض المنتج</th>
                </tr>
            </thead>

            <tbody>



                @foreach ($order as $item)
                    <tr>
                        <td class="img_deg">
                            <img src="{{ asset('images/' . $item->image) }}" style="height: 200px; width: 150px;"
                                alt="">
                        </td>
                        <td>{{ $item->product_title }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->payment_status }}</td>
                        <td>{{ $item->delivery_status }}</td>

                        <td>
                            @if ($item->delivery_status == 'يتم المعالجة')
                                <a class="btn btn-danger" onClick="return confirm('هل أنت متأكد من إلغاء هذا الطلب؟');"
                                    href="{{ route('cancel_order', $item->id) }}">إلغاء الطلب</a>
                            @else
                                <p style="color: red;">غير مسموح</p>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('product_detail', $item->rProduct->id) }}">الذهاب الي
                                المنتج</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
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
