@extends('layouts.main')

@section('title','Product')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/product.css">
    <link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
    <style>
        .details_image_large {
            position: relative;
            display: inline-block;
        }

        .details_image_large img {
            max-width: 100%;
            height: auto;
        }

        .prev_image_arrow,
        .next_image_arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            color: #333;
            background-color: #fff;
            padding: 8px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1; /* Добавляем z-index, чтобы стрелки были поверх изображения */
        }

        .prev_image_arrow {
            left: 10px;
        }

        .next_image_arrow {
            right: 10px;
        }
    </style>

@endsection

@section('custom_js')
    <script src="/js/product.js"></script>
    <!-- Удалите обработчики событий для кнопок Up и Down -->
    <script>
        $(document).ready(function () {
            // При нажатии на миниатюру, меняем изображение в большом блоке
            $('.details_image_thumbnail').click(function () {
                let newImage = $(this).data('image');
                $('.details_image_large img').attr('src', newImage);
                // Добавляем класс "active" к выбранной миниатюре
                $('.details_image_thumbnail').removeClass('active');
                $(this).addClass('active');
            });

            // Функция для обновления позиции блока с миниатюрами
            function updateThumbnailPosition() {
                let thumbnailWidth = $('.details_image_thumbnail').outerWidth();
                let thumbnailContainerWidth = $('.details_image_thumbnails').outerWidth();
                let maxOffset = thumbnailWidth * (thumbnailCount - 1) - thumbnailContainerWidth;
                let offset = -currentThumbnail * thumbnailWidth;
                if (offset > maxOffset) {
                    offset = maxOffset;
                }
                $('.details_image_thumbnails').css('left', offset);
            }

            // Добавьте следующий код после обработчиков событий для миниатюр
            $('.prev_thumbnail_arrow').click(function (e) {
                e.preventDefault();
                if (currentThumbnail > 0) {
                    currentThumbnail--;
                    updateThumbnailPosition();
                }
            });

            $('.next_thumbnail_arrow').click(function (e) {
                e.preventDefault();
                if (currentThumbnail < thumbnailCount - 1) {
                    currentThumbnail++;
                    updateThumbnailPosition();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function()    {
            $('.cart_button').click(function(event){
                event.preventDefault()
                addToCart()
            })
        })
        function addToCart() {
            let id = $('.details_name').data('id')
            let qty = parseInt($('#quantity_input').val())

            let total_qty = parseInt($('.cart-qty').text())
            total_qty += qty
            $('.cart-qty').text(total_qty)

            $.ajax({
                url: "{{route('addToCart')}}",
                type: "POST",
                data: {
                   id: id,
                   qty: qty,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                console.log(data)
                }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            // Обработчики событий для стрелок на главном изображении
            $('.prev_image_arrow').click(function (e) {
                e.preventDefault();
                let prevThumbnail = $('.details_image_thumbnail.active').prev('.details_image_thumbnail');
                if (prevThumbnail.length > 0) {
                    prevThumbnail.click();
                }
            });

            $('.next_image_arrow').click(function (e) {
                e.preventDefault();
                let nextThumbnail = $('.details_image_thumbnail.active').next('.details_image_thumbnail');
                if (nextThumbnail.length > 0) {
                    nextThumbnail.click();
                }
            });
        });
    </script>

@endsection

@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url('/images/a1f.jpg')"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">Trade-In<span>.</span></div>
                                <div class="home_text"><p>Exchange your old device for a new one at a favorable rate!
                                        Give us your old device at the best possible price, get a new device in return with a 1-year warranty!</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <div style="background-color: white; height: 100px; position: relative"></div>

    <div class="product_details">
        <div class="container">
            <div class="row details_row">

                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="details_image">
                        @php
                            $image = '';
                            if(count($item->images) > 0){
                                $image = $item->images[0]['img'];
                            } else {
                                $image = 'no_image.png';
                            }
                        @endphp
                        <div class="details_image_large">
                            <img src="/images/{{$image}}" alt="{{$item->title}}">
                            <div class="product_extra product_new"><a>Used</a></div>
                            <a class="prev_image_arrow" href="#"><i class="fa fa-chevron-left"></i></a>
                            <a class="next_image_arrow" href="#"><i class="fa fa-chevron-right"></i></a>
                        </div>
                        <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                            @if($image == 'no_image.png')
                            @else
                                @foreach($item->images as $img)
                                    @if($loop->first)
                                        <div class="details_image_thumbnail active" data-image="/images/{{$img['img']}}"><img src="/images/{{$img['img']}}" alt="{{$item->title}}"></div>
                                    @else
                                        <div class="details_image_thumbnail" data-image="/images/{{$img['img']}}"><img src="/images/{{$img['img']}}" alt="{{$item->title}}"></div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">
                    <div class="details_content">
                        <div class="details_name">{{$item->title}}</div>
                        @if($item->new_price != null)
                        <div class="details_discount">${{$item->price}}</div>
                        <div class="details_price">${{$item->new_price}}</div>
                        @else
                            <div class="details_price">${{$item->price}}</div>
                        @endif
                        <!-- In Stock -->
                        <div class="in_stock_container">
                            <div class="availability">Availability:</div>
                            @if($item->in_stock)
                               <span>In Stock</span>
                            @else
                                <span style="color: red">No Stock</span>
                            @endif
                        </div>
                        <div class="details_text">
                            <p>{{$item->description}}</p>
                        </div>

                        <!-- Product Quantity -->
                        <div class="product_quantity_container">
                            <div class="product_quantity clearfix">
                                <span>Qty</span>
                                <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                <div class="quantity_buttons">
                                    <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                    <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            <div class="button cart_button"><a href="#">Add to cart</a></div>
                        </div>

                        <!-- Share -->
                        <div class="details_share">
                            <span>Share:</span>
                            <ul>
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row description_row">
                <div class="col">
                    <div class="description_title_container">
                        <div class="description_title">Description</div>
                        <div class="reviews_title"><a href="#">Reviews <span>(1)</span></a></div>
                    </div>
                    <div class="description_text">
                        <p>{{$item->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="products_title">Related Products</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="product_grid">

                        @foreach($products as $product)
                            <!-- Product -->
                            @php
                                $image = '';
                                if(count($product->images) > 0 ){
                                $image = $product->images[0]['img'];
                                }else {
                                $image = 'no_image.png';
                            }
                            @endphp
                            <div class="product">
                                <div class="product_image"><img src="/images/{{$image}}" alt="{{$product->title}}"></div>
                                <div class="product_extra product_new"><a href="{{route('showCategory',$product->category['alias'])}}">{{$product->category['title']}}</a></div>
                                <div class="product_content">
                                    <div class="product_title"><a href="{{route('showProduct',['category',$product->id])}}">{{$product->title}}</a></div>
                                    @if($product->new_price != null)
                                        <div class="product_old_price">${{$product->price}}</div>
                                        <div class="product_price">${{$product->new_price}}</div>
                                    @else
                                        <div class="product_price">${{$product->price}}</div>
                                    @endif
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Newsletter

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="newsletter_border"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="newsletter_content text-center">
                        <div class="newsletter_title">Subscribe to our newsletter</div>
                        <div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
                        <div class="newsletter_form_container">
                            <form action="#" id="newsletter_form" class="newsletter_form">
                                <input type="email" class="newsletter_input" required="required">
                                <button class="newsletter_button trans_200"><span>Subscribe</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
@endsection


