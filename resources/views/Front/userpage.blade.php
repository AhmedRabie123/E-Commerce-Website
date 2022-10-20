<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="front/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="front/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="front/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="front/css/responsive.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <div class="hero_area">

        {{-- if for message success --}}
        @if (session()->has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('success') }}
            </div>
        @endif

        <!-- header section strats -->
        @include('Front.header')
        <!-- end header section -->
        <!-- slider section -->
        @include('Front.slider')
        <!-- end slider section -->
    </div>
    <!-- why section -->
    @include('Front.why')
    <!-- end why section -->

    <!-- arrival section -->
    @include('Front.new_arrival')
    <!-- end arrival section -->

    <!-- product section -->
    @include('Front.product')
    <!-- end product section -->


    {{-- Comment And Reply System Started Here  --}}


    <div style="text-align: center; padding-bottom: 30px">

        <h1 style="font-size: 30px; text-align: center; padding-top: 20px; padding-bottom: 20px">Comments</h1>

        <form action="{{ route('add_comment') }}" method="POST">
            @csrf
            <textarea style="height: 100px; width: 500px;" name="comment" id="" cols="30" rows="10"
                placeholder="أكتب تعليقك هنا"></textarea><br>
            <input type="submit" class="btn btn-primary" value="تعليق">
        </form>

    </div>

    <div style="padding-left: 20%;">
        <h1 style="font-size: 20px; padding-bottom: 20px">جميع التعليقات السابقه</h1>

        @foreach ($comment as $item1)
            <div>
                <b>{{ $item1->name }}</b>
                <p>{{ $item1->comment }}</p>

                <a style="color: blue" href="javascript::void(0);" onclick="reply(this)" data_commentid="{{ $item1->id }}">رد</a>

                @foreach ($reply as $item2)
                    @if ($item2->comment_id == $item1->id)
                        <div style="padding-left: 3%; padding-top: 10px; padding-bottom: 10px;">
                            <b>{{ $item2->name }}</b>
                            <p>{{ $item2->reply }}</p>
                            <a style="color: blue" href="javascript::void(0);" onclick="reply(this)" data_commentid="{{ $item1->id }}">رد</a>
                        </div>
                    @endif
                @endforeach

            </div>
        @endforeach




        {{-- reply textbox --}}

        <div style="display: none;" class="replyDiv">
            <form action="{{ route('add_reply') }}" method="POST">
                @csrf
                <input type="text" id="commentId" name="commentId" hidden>
                <textarea style="height: 80px; width: 380px;" name="reply" id="" cols="30" rows="10"
                    placeholder="write something here"></textarea><br>
                <button type="submit" class="btn btn-warning">الرد</button>
                <a href="javascript::void(0);" class="btn" onclick="reply_close(this)">إلغاء</a>
            </form>
        </div>

    </div>







    {{-- Comment And Reply System Ended Here  --}}



    <!-- subscribe section -->
    @include('Front.subscribe')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('Front.client')
    <!-- end client section -->
    <!-- footer start -->
    @include('Front.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto"><a href="https://web.facebook.com/ahmed.rabea.10048/">Ahmed Rabie</a> جميع الحقوق محفوظه لدي
            © 2021<br>

            وزعت من خلال <a href="https://themewagon.com/" target="_blank">Ahmed Rabie</a>

        </p>
    </div>


    <script>
        function reply(caller) {

            document.getElementById('commentId').value = $(caller).attr('data_commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
        }

        function reply_close(caller) {

            $('.replyDiv').hide();
        }
    </script>


<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>


    <!-- jQery -->
    <script src="front/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="front/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="front/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="front/js/custom.js"></script>
</body>

</html>
