<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <base href="/public">
    @include('Admin.css')

    <style>
        label
        {
            display: inline-block;
            width: 300px;
            font-weight: bold;
        }
    </style>

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

                <h1 style="font-size: 24px; text-align: center"> {{ $order->email }} : إرسال بريد إلكتروني إلى</h1>

                <form action="{{ route('email_submit', $order->id) }}" method="POST">
                    @csrf

                    <div style="padding-left: 35%; padding-top: 30px;">
                        <input type="text" class="" style="color: black" name="subject">
                        <label for=""> : عنوان البريد الإلكتروني</label>
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px;">
                        <input type="text" class="" style="color: black" name="firstline">
                        <label for=""> :السطر الأول للبريد الإلكتروني</label>
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px;">
                        <input type="text" class="" style="color: black" name="body">
                        <label for=""> :موضوع البريد الإلكتروني</label>
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px;">
                        <input type="text" class="" style="color: black" name="button">
                        <label for=""> :زر البريد الإلكتروني</label>
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px;">
                        <input type="text" class="" style="color: black" name="url">
                        <label for=""> :رابط البريد الإلكتروني</label>
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px;">
                        <input type="text" class="" style="color: black" name="lastline">
                        <label for=""> :آخر سطر بالبريد الإلكتروني</label>
                    </div>

                    <div style="padding-left: 35%; padding-top: 30px;">
                        <input type="submit" class="btn btn-primary" value="إرسال">
                    </div>

                </form>

            </div>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('Admin.script')
        <!-- End custom js for this page -->
</body>

</html>
