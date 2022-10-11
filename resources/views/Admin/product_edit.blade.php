<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <base href="/public">
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
                    <form action="{{ route('product_update', $product_single->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 style="text-align: center; font-size: 30px;">تعديل المنتج</h5>

                                        <div class="form-group mb-3">
                                            <label>* عنوان المنتج</label>
                                            <input type="text" style="color: beige;" class="form-control" name="title" value="{{ $product_single->title }}" placeholder="عنوان المنتج" required="">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>* وصف المنتج</label> 
                                            <textarea name="description" style="color: beige;" class="form-control" cols="30" rows="10" placeholder="وصف المنتج" required="">{{ $product_single->description }}</textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>الصوره الحاليه</label>
                                            <div> 
                                                <img src="{{ asset('images/'. $product_single->image) }}" style="height: 150px" alt="">
                                            </div>
                                        </div><br>

                                        <div class="form-group mb-3">
                                            <label>إختيار صوره جديده</label>
                                            <div> <input type="file" name="image"> </div>
                                        </div> 

                                      <div class="form-group mb-3">
                                            <label>* الفئه</label>
                                            <select name="category_id" class="form-control select2" required="" style="color: beige;">
                                                 <option value="">* فئة المنتج</option> 
                                                 @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}" selected>
                                                        {{ $item->category_name }}
                                                    </option>
                                                @endforeach 
                                            </select>
                                     </div>  

                                        <div class="form-group mb-3">
                                            <label>* كميه المنتج</label>
                                            <input type="number" style="color: beige;" class="form-control" name="quantity" value="{{ $product_single->quantity }}" placeholder="كمية المنج" required="">
                                        </div>
                                     
                                        <div class="form-group mb-3">
                                            <label>* سعر المنتج</label>
                                            <input type="number" style="color: beige;" class="form-control" name="price" value="{{ $product_single->price }}" placeholder="سعر المنتج" required="">
                                        </div>
                                      
                                        <div class="form-group mb-3">
                                            <label>سعر الخصم</label>
                                            <input type="number" style="color: beige;" class="form-control" name="discount_price" value="{{ $product_single->discount_price }}" placeholder="سعر الخصم علي المنتج">
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
