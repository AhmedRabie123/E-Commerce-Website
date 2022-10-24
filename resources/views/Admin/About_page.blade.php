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


                @foreach ($about as $row)
                    <div class="section-body">
                        <form action="{{ route('about_update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 style="text-align: center; font-size: 30px;">تعديل عننا</h4> <br>

                                            <div class="form-group mb-3">
                                                <label>العنوان</label>
                                                <input type="text" class="form-control" style="color: black;"
                                                    name="about_title" value="{{ $row->about_title }}" required="">
                                            </div>


                                            <div class="form-group mb-3">
                                                <label>التفاصيل</label><br>
                                                <textarea class="form-control" style="color: white;" name="about_detail" id="" cols="30" rows="10">{{ $row->about_detail }}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">تعديل</button>
                            </div>
                        </form>
                    </div>
                @endforeach

            </div>
        </div>


        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('Admin.script')
        <!-- End custom js for this page -->
</body>

</html>
