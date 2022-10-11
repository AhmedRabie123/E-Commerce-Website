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

                <a href="{{ route('product_create') }}"><button type="button" class="btn btn-primary">إضافة
                        منتج</button></a>

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
                                                    <th>عنوان المنتج</th>
                                                    <th>وصف المنتج</th>
                                                    <th>فئة المنتج</th>
                                                    <th>الكميه المتوفره</th>
                                                    <th>السعر</th>
                                                    <th>قيمة الخصم</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($products as $row)
                                                    <tr>
                                                        <td style="color:beige;">{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ asset('images/' . $row->image) }}"
                                                                alt="" style="height: 86px;">
                                                        </td>
                                                        <td style="color:beige;">{{ $row->title }}</td>
                                                        <td style="color:beige;">{{ $row->description }}</td>
                                                        <td style="color:beige;">{{ $row->category_id }}</td>
                                                        <td style="color:beige;">{{ $row->quantity }}</td>
                                                        <td style="color:beige;">{{ $row->price }}</td>
                                                        <td style="color:beige;">{{ $row->discount_price }}</td>
                                                        <td class="pt_10 pb_10">
                                                            <a href="{{ route('product_edit', $row->id) }}"
                                                                class="btn btn-primary">Edit</a>
                                                            <a href="{{ route('product_delete', $row->id) }}"
                                                                class="btn btn-danger"
                                                                onClick="return confirm('Are you sure?');">Delete</a>
                                                        </td>

                                                    </tr>
                                                @endforeach

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
