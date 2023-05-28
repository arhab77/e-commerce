@extends('layout.home')

@section('title','Home')



@section('content')
<div class="container" style="margin-bottom: 20px">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="hero__item set-bg" data-setbg="/uploads/sliders.png">
                <div class="hero__text">
                    <span>FRUIT FRESH</span>
                    <h2>Fruits <br />100% Fresh</h2>
                    <p>Gratis Ongkir Wilayah Samarinda</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero__item set-bg" data-setbg="/uploads/sliders2.png">
                <div class="hero__text">
                    <span>ANEKA SEMBAKO</span>
                    <h2>Sembako <br />Terbaik</h2>
                    <p>Gratis Ongkir Wilayah Samarinda</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero__item set-bg" data-setbg="/uploads/sliders3.png">
                <div class="hero__text">
                    <span>ANEKA SNACK</span>
                    <h2>Snack <br />Enak & Gurih</h2>
                    <p>Gratis Ongkir Wilayah Samarinda</p>
                </div>
            </div>
        </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
            
        </div>
        <!-- Categories Section Begin -->
        <section class="categories">
            <div class="container">
                <div class="row">
                    <div class="categories__slider owl-carousel">
                        @php
                            //$categories = App\Models\category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <div class="col-lg-3">
                                <div class="categories__item set-bg" data-setbg="/uploads/{{$category->gambar}}">
                                    <h5><a href="/product/{{$category->id}}">{{$category->nama_kategori}}</a></h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Categories Section End -->
    
        <!-- Featured Section Begin -->
        <section class="featured spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>All Product</h2>
                        </div>
                        <section class="hero hero-normal">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="hero__search">
                                            <div class="hero__search__form">
                                                <form action="#">
                                                    <input type="text" placeholder="Apa yang anda cari?">
                                                    <button type="submit" class="site-btn">SEARCH</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row featured__filter">
                    @foreach ($products as $produk)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <input type="hidden" id="id_barang_{{$produk->id}}" value="{{$produk->id}}">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="/uploads/{{$produk->gambar}}">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-shopping-cart" onclick="addToCart({{$produk->id}}, {{$produk->harga}})"></i></a></li>
                                        <li><a href="/shop/{{$produk->id}}"><i class="fa fa-info"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="/eshop/#">{{$produk->nama_barang}}</a></h6>
                                    <h5>Rp. {{number_format($produk->harga)}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Featured Section End -->
@endsection
@push('js')
    <script>
        function addToCart(id_barang, harga) {
            var id_member = "{{ Auth::guard('webmember')->check() ? Auth::guard('webmember')->user()->id : null }}";
            if (id_member === null) {
                // Handle the case where the user is not authenticated
                return;
            }
            var jumlah = 1;
            var total = harga * jumlah;
            var is_checkout = 0;

            $.ajax({
                url: '/add_to_cart',
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                data: {
                    id_member: id_member,
                    id_barang: id_barang,
                    jumlah: jumlah,
                    total: total,
                    is_checkout: is_checkout,
                },
                success: function(data) {
                    window.location.href = '/cart';
                }
            });
        }
    </script>
@endpush
