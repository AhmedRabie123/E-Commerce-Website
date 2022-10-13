<section class="product_section layout_padding">
    <div class="container" id="product">
        <div class="heading_container heading_center">
            <h2>
                عن <span>منتجاتنا </span>
            </h2>
        </div>
        <div class="row">

            @foreach ($product as $item)
            
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ route('product_detail', $item->id) }}" class="option1">
                                    {{-- {{ $item->rCategory->category_name }} --}}
                                    تفاصيل المنتج
                                </a>
                                <form action="{{ route('add_cart', $item->id) }}" method="post">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-4">
                                            <input type="number" name="quantity" value="1" min="1" style="width: 100px; border-radius: 20px">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" value="أضف إلى السلة" style="border-radius: 30px">
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="{{ asset('images/' . $item->image) }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $item->title }}
                            </h5>

                            @if ($item->discount_price != null)
                                <h6 style="color: red;">
                                    سعر الخصم
                                    <br>
                                    E£{{ $item->discount_price }}
                                </h6>

                                <h6 style="text-decoration: line-through; color:blue;">
                                    السعر
                                    <br>
                                    E£{{ $item->price }}
                                </h6>
                            @else
                                <h6 style="color: blue;">
                                    السعر
                                    <br>
                                    E£{{ $item->price }}
                                </h6>
                            @endif

                        </div>
                    </div>
                </div>

            @endforeach

        </div>


        {{ $product->links() }}



        <div class="btn-box">
            <a href="">
                مشاهدة جميع المنتجات
            </a>
        </div>
    </div>
</section>
