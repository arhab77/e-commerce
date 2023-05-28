@extends('layout.home')

@section('title','Checkout')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/eshop/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Detail Pembayaran</h4>
                <form method="POST" action="/payments">
                    @csrf
                    <input type="hidden" name="id_order" value="{{$orders->id}}">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>Provinsi</p>
                                <select name="provinsi" id="provinsi" class="checkout__input provinsi">
                                    <option value="">--Pilih Provinsi--</option>
                                    @foreach ($provinsi->rajaongkir->results as $provinsi)
                                        <option value="{{$provinsi->province_id}}">{{$provinsi->province}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Kota</p>
                                <select name="kabupaten" id="kota" class="checkout__input kota">
                                    
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Detail Alamat</p>
                                <input type="text" placeholder value name="detail_alamat">
                            </div>
                            <div class="checkout__input">
                                <p>Atas Nama</p>
                                <input type="text" placeholder value name="atas_nama">
                            </div>
                            <div class="checkout__input">
                                <p>No. Rekening</p>
                                <input type="text" placeholder value name="no_rekening">
                            </div>
                            <div class="checkout__input">
                                <p>Nominal Transfer</p>
                                <input type="text" placeholder value name="jumlah">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__total">Total <span>Rp. {{number_format($orders->total_harga)}}</span></div>
                                <div>
                                    <label for="acc-or">
                                        BRI
                                    </label>
                                </div>
                                <p>7336-01-013479-53-1 a.n (Muhammad Fadhil arhab)</p>
                                <div>
                                    <label for="acc-or">
                                        DANA
                                    </label>
                                </div>
                                <p>0899-8935-446 a.n (Muhammad Fadhil arhab)</p>
                                    
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection

@push('js')
    <script>
        $(function(){
            $('.provinsi').change(function(){
                $.ajax({
                    url : '/get_kota/' + $(this).val(),
                    success : function(data){
                        data = JSON.parse(data);
                        var option = "";
                        data.rajaongkir.results.map((kota)=> {
                            option += `<option value=${kota.city_id}>${kota.city_name}</option>`
                        });
                        $('.kota').html(option);
                        $('.kota').niceSelect('update');
                    }
                });
            });
        });
    </script>
@endpush