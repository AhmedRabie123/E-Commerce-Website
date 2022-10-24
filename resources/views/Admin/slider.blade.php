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

                <a href="{{ route('slider_create') }}"><button type="button" class="btn btn-primary">إضافة
                        سلايدر</button></a>

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
                                                    <th>صورة السلايدر</th>
                                                    <th>العنوان الاول للسلايدر</th>
                                                    <th>العنوان الثاني للسلايدر</th>
                                                    <th>تفاصيل السلايدر</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($slider as $row)
                                                    <tr>
                                                        <td style="color:beige;">{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ asset('images/' . $row->image) }}"
                                                                alt="" style="height: 100px; width: 100px;">
                                                        </td>
                                                        <td style="color:beige;">{{ $row->title }}</td>
                                                        <td style="color:beige;">{{ $row->sub_title }}</td>
                                                        <td style="color:beige;">{{ $row->detail }}</td>
                                                        <td class="pt_10 pb_10">
                                                            <a href="{{ route('slider_edit', $row->id) }}"
                                                                class="btn btn-primary">تعديل</a>
                                                            <a href="{{ route('slider_delete', $row->id) }}"
                                                                onClick="return confirm('هل انت متأكد من حذف هذا ؟');"
                                                                class="btn btn-danger"
                                                                onClick="return confirm('Are you sure?');">حذف</a>
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
