<!DOCTYPE html>
<html>

<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('front/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>


<body>

    @include('sweetalert::alert')

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
                placeholder="???????? ???????????? ??????"></textarea><br>
            <input type="submit" class="btn btn-primary" value="??????????">
        </form>

    </div>

    <div style="padding-left: 20%;">
        <h1 style="font-size: 20px; padding-bottom: 20px">???????? ?????????????????? ??????????????</h1>

        @foreach ($comment as $item1)
            <div>
                <b>{{ $item1->name }}</b>
                <p>{{ $item1->comment }}</p>

                <a style="color: blue" href="javascript::void(0);" onclick="reply(this)"
                    data_commentid="{{ $item1->id }}">????</a>

                @foreach ($reply as $item2)
                    @if ($item2->comment_id == $item1->id)
                        <div style="padding-left: 3%; padding-top: 10px; padding-bottom: 10px;">
                            <b>{{ $item2->name }}</b>
                            <p>{{ $item2->reply }}</p>
                            <a style="color: blue" href="javascript::void(0);" onclick="reply(this)"
                                data_commentid="{{ $item1->id }}">????</a>
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
                <button type="submit" class="btn btn-warning">????????</button>
                <a href="javascript::void(0);" class="btn" onclick="reply_close(this)">??????????</a>
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
        <p class="mx-auto"><a href="https://web.facebook.com/ahmed.rabea.10048/">Ahmed Rabie</a> ???????? ???????????? ???????????? ??????
            ?? 2021<br>

            ???????? ???? ???????? <a href="https://themewagon.com/" target="_blank">Ahmed Rabie</a>

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
