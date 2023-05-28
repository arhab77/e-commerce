@extends('layout.home')

@section('title','Product')

@section('content')
        <!-- Categories Section Begin -->
        <section class="categories">
            <div class="container">
                <div class="row">
                    <div class="categories__slider owl-carousel">
                        @php
                            $categories = App\Models\category::all();
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
                            <h2>Featured Product</h2>
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
                </div><div class="row featured__filter">
            </div>
        </section>
        <!-- Featured Section End -->
@endsection