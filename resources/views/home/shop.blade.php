@extends('layout.home')

@section('title','Shop')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/eshop/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

     <!-- Product Details Section Begin -->
     <section class="product-details spad">
        <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__item">
                                <img class="product__details__pic__item--large"
                                    src="/uploads/{{$product->gambar}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__text">
                            <h3>{{$product->nama_barang}}</h3>
                            <div class="product__details__price">Rp. {{number_format($product->harga)}}</div>
                            <p>{{$product->deskripsi}}</p>
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" class="jumlah">
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="primary-btn add-to-card">ADD TO CARD</a>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <!-- Product Details Section End -->

@endsection
@push('js')
    <script>
        $(function(){
            $('.add-to-card').click(function(e){
                id_member = "{{ Auth::guard('webmember')->check() ? Auth::guard('webmember')->user()->id : null }}";
                if (id_member === null) {
                    // Handle the case where the user is not authenticated
                    return;
                }
                id_barang = {{$product->id}}
                jumlah = $('.jumlah').val()
                total = {{$product->harga}} * jumlah
                is_checkout = 0

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
            })
        })
    </script>
@endpush
