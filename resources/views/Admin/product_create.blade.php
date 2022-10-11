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
                <a href="{{ route('product') }}"><button type="button" class="btn btn-primary">عرض المنتجات</button></a>


                <div class="section-body">
                    <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 style="text-align: center; font-size: 30px;">إضافة منتج</h5>

                                        <div class="form-group mb-3">
                                            <label>* عنوان المنتج</label>
                                            <input type="text" class="form-control" name="title" value="" placeholder="عنوان المنتج" required="">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>* وصف المنتج</label> 
                                            <textarea name="description" class="form-control" cols="30" rows="10" placeholder="وصف المنتج" required=""></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>* صورة المنتج</label>
                                            <div> <input type="file" name="image" required=""> </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>* الفئه</label>
                                            <select name="category_id" class="form-control select2" required="" style="color: beige;">
                                                {{-- <option value="">* فئة المنتج</option> --}}
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->category_name }}">
                                                        {{ $item->category_name }}
                                                    </option>
                                                @endforeach 
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>* كميه المنتج</label>
                                            <input type="number" class="form-control" name="quantity" value="" placeholder="كمية المنج" required="">
                                        </div>
                                     
                                        <div class="form-group mb-3">
                                            <label>* سعر المنتج</label>
                                            <input type="number" class="form-control" name="price" value="" placeholder="سعر المنتج" required="">
                                        </div>
                                      
                                        <div class="form-group mb-3">
                                            <label>* سعر الخصم</label>
                                            <input type="number" class="form-control" name="discount_price" value="" placeholder="سعر الخصم علي المنتج">
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
