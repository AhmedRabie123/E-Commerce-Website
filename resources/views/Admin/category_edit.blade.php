{{-- <!DOCTYPE html>
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
        <!-- partial --> --}}


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
          {{-- <!-- container-scroller -->
        <!-- plugins:js -->
        @include('Admin.script')
        <!-- End custom js for this page --> --}}
</body>

</html>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
