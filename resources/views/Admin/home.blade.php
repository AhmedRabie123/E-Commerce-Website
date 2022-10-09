<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('Admin.css')
  </head>
  <body>
    <div class="container-scroller" dir="rtl">
      <!-- partial:partials/_sidebar.html -->
        @include('Admin.sidebar')
      <!-- partial -->
        @include('Admin.header')
        <!-- partial -->
        @include('Admin.body')
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('Admin.script')
    <!-- End custom js for this page -->
  </body>
</html>