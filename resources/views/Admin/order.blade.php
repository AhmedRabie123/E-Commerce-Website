<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('Admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('Admin.sidebar')
        <!-- partial -->
        @include('Admin.header')
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div style="padding-left: 330px; padding-bottom: 30px;">
                    <form action="{{ route('search_order') }}" method="get">
                        @csrf
                        <input type="text" style="color: black" name="search" placeholder="قم بالبحث عن الطلبات">
                        <input type="submit" class="btn btn-outline-primary" value=" : بحث">
                    </form>
                </div>


                <h1 style="font-size: 25px; text-align: center; padding-bottom: 30px; font-weight: bold;"> All Orders
                </h1>

                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="example1">
                                            <thead>
                                                <tr style="background: rgb(43, 62, 72);">
                                                    <th>SL</th>
                                                    <th>صورة المنتج</th>
                                                    <th>ألاسم</th>
                                                    <th>البريد الالكتروني</th>
                                                    <th>العنوان</th>
                                                    <th>رقم التليفون</th>
                                                    <th>عنوان المنتج</th>
                                                    <th>الكميه</th>
                                                    <th>السعر</th>
                                                    <th>حالة الدفع</th>
                                                    <th>حالة التسليم</th>
                                                    <th>تم التوصيل</th>
                                                    <th>PDF تحميل</th>
                                                    <th>أرسل بريد الكتروني</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @forelse ($order as $row)
                                                    <tr>
                                                        <td style="color:beige;">{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ asset('images/' . $row->image) }}"
                                                                alt="" style="height: 86px; width: 200px">
                                                        </td>
                                                        <td style="color:beige;">{{ $row->name }}</td>
                                                        <td style="color:beige;">{{ $row->email }}</td>
                                                        <td style="color:beige;">{{ $row->address }}</td>
                                                        <td style="color:beige;">{{ $row->phone }}</td>
                                                        <td style="color:beige;">{{ $row->product_title }}</td>
                                                        <td style="color:beige;">{{ $row->quantity }}</td>
                                                        <td style="color:beige;">{{ $row->price }}</td>
                                                        <td style="color:beige;">{{ $row->payment_status }}</td>
                                                        <td style="color:beige;">{{ $row->delivery_status }}</td>

                                                        <td class="pt_10 pb_10">
                                                            @if ($row->delivery_status == 'يتم المعالجة')
                                                                <a href="{{ route('delivered', $row->id) }}"
                                                                    onclick="return confirm('هل تريد تعديل حالة التسليم لهذا الطلب')"
                                                                    class="btn btn-primary">تم التوصيل</a>
                                                            @else
                                                                <p style="color: green;">تم التوصيل</p>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('print_pdf', $row->id) }}"
                                                                onclick="return confirm('هل تريد تحميل هذا الطلب بواسطة PDF')"
                                                                class="btn btn-info">PDFتحميل</a>
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('send_email', $row->id) }}"
                                                                onclick="return confirm('هل تريد إرسال إيميل الي هذا الشخص PDF')"
                                                                class="btn btn-secondary">إرسال إيميل</a>
                                                        </td>


                                                    </tr>


                                                @empty
                                                    <tr>
                                                        <td colspan="10" style="text-align: center; color: red;">
                                                            No Data Found
                                                        </td>
                                                    </tr>
                                                       
                                           
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('Admin.script')
        <!-- End custom js for this page -->
</body>

</html>
