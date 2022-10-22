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


                <a href="{{ route('category') }}"><button type="button" class="btn btn-primary">عرض الفئات</button></a>
                <div class="section-body">
                    <form action="{{ route('category_update', $category_single->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="text-align: center; font-size: 30px;">تعديل الفئه</h4> <br>

                                        <div class="form-group mb-3">
                                            <label>أسم الفئه *</label>
                                            <input type="text" class="form-control" style="color: black;"
                                                name="category_name" value="{{ $category_single->category_name }}" required="">
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



                </div>
        </div> 
          <!-- container-scroller -->
        <!-- plugins:js -->
        @include('Admin.script')
        <!-- End custom js for this page -->
</body>

</html>

