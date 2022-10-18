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
                
               <a href="{{ route('category_create') }}"><button type="button" class="btn btn-primary">إضافة فئه</button></a>
                <div class="section-body" >
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="example1">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center">الرقم التسلسلي</th>
                                                    <th style="text-align: center; width: 550px">أسم الفئه</th>
                                                    <th style="text-align: center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
            
                                               @foreach ($categories as $row)
                                               <tr>
                                                <td style="color: beige; text-align: center">{{ $loop->iteration }}</td>
                                                <td style="color: beige; text-align: center">{{ $row->category_name }}</td>
                                              
                                                <td class="pt_10 pb_10">
                                                    <a href="{{ route('category_edit', $row->id) }}"
                                                        class="btn btn-primary">تعديل</a>
                                                    <a href="{{ route('category_delete', $row->id) }}"
                                                        class="btn btn-danger"
                                                        onClick="return confirm('هل أنت متأكد من حذف هذا؟');">حذف</a>
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





