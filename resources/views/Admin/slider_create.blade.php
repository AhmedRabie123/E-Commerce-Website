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


        <div class="main-panel" >
            <div class="content-wrapper">


                @if (session()->has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('success') }}
                </div>
            @endif
            <a href="{{ route('slider_show') }}"><button type="button" class="btn btn-primary">عرض السلايدرات</button></a>


            <div class="section-body">
                <form action="{{ route('slider_store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 style="text-align: center; font-size: 30px;">إضافة إسلايدر</h5>

                                    <div class="form-group mb-3">
                                        <label>* العنوان الاول للسلايدر</label>
                                        <input type="text" style="color: beige;" class="form-control" name="title" value="" placeholder="العنوان الاول للسلايدر" required="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>* العنوان الثاني للسلايدر</label>
                                        <input type="text" style="color: beige;" class="form-control" name="sub_title" value="" placeholder="العنوان الثاني للسلايدر" required="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>* وصف السلايدر</label> 
                                        <textarea name="detail" style="color: beige;" class="form-control" cols="30" rows="10" placeholder="وصف السلايدر" required=""></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>* صورة السلايدر</label>
                                        <div> <input type="file" name="image" required=""> </div>
                                    </div>

               
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">حفظ</button>
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