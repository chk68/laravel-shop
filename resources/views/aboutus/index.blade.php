@extends('layouts.main')

@section('title','Contact')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/contact.css">
    <link rel="stylesheet" type="text/css" href="/styles/contact_responsive.css">
@endsection

@section('custom_js')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
    <script src="/js/contact.js"></script>
@endsection

@section('content')

    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(images/contact.jpg)"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="breadcrumbs">
                                    <ul>
                                        <li><a href="/">Home</a></li>
                                        <li>About us </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->

    <div class="contact">
        <div class="container">
            <div class="row">

                <!-- Get in touch -->
                <div class="col-lg-8 contact_col">
                    <div class="aboutus">
                        <div class="section_title">Welcome to Electronics Haven!</div>
                        <div class="section_subtitle">
                            <p>At Electronics Haven, we are passionate about all things electronics. Our online store is your one-stop destination for the latest gadgets, cutting-edge technology, and top-quality electronic products.</p>

                            <p>Founded with the mission to provide exceptional customer service and deliver the best products to our valued customers, we take pride in offering a wide range of electronics that cater to every need and lifestyle.</p>

                            <p>Our team of tech enthusiasts carefully curates the products available on our platform, ensuring that only the most reliable and innovative items make it to your hands. Whether you're looking for smartphones, laptops, smartwatches, or other electronic accessories, we've got you covered.</p>

                            <p>We believe that technology should be accessible to everyone, which is why we strive to keep our prices competitive without compromising on quality. With secure and hassle-free payment options, fast shipping, and excellent customer support, your shopping experience with us is bound to be a delight.</p>

                            <p>Join us on this exciting journey through the world of electronics. Explore our vast selection of products, find what you love, and elevate your digital lifestyle with Electronics Haven.</p>

                            <p>Thank you for choosing us as your trusted electronics provider. We look forward to serving you and making your tech dreams a reality.</p>

                            <p>Happy shopping!</p>

                            <p>The Electronics Haven Team</p>
                        </div>
                    </div>
                </div>


                <!-- Contact Info -->
                <div class="col-lg-3 offset-xl-1 contact_col">
                    <div class="contact_info">
                        <div class="contact_info_section">
                            <div class="contact_info_title">Marketing</div>
                            <ul>
                                <li>Phone: <span>+53 345 7953 3245</span></li>
                                <li>Email: <span>yourmail@gmail.com</span></li>
                            </ul>
                        </div>
                        <div class="contact_info_section">
                            <div class="contact_info_title">Shippiing & Returns</div>
                            <ul>
                                <li>Phone: <span>+53 345 7953 3245</span></li>
                                <li>Email: <span>yourmail@gmail.com</span></li>
                            </ul>
                        </div>
                        <div class="contact_info_section">
                            <div class="contact_info_title">Information</div>
                            <ul>
                                <li>Phone: <span>+53 345 7953 3245</span></li>
                                <li>Email: <span>yourmail@gmail.com</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row map_row">
                <div class="col">

                    <!-- Google Map -->
                    <div class="map">
                        <div id="google_map" class="google_map">
                            <div class="map_container">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .about-us {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            margin-bottom: 15px;
        }

    </style>

@endsection
