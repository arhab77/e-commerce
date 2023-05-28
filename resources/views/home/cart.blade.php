@extends('layout.home')

@section('title','Cart')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/eshop/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <form class="form-cart">
                <input type="hidden" name="id_member" value="{{Auth::guard('webmember')->user()->id}}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Products</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                    <input type="hidden" name="id_produk[]" value="{{$cart->product->id}}">
                                    <input type="hidden" name="jumlah[]" value="{{$cart->jumlah}}">
                                    <input type="hidden" name="total[]" value="{{$cart->total}}">
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="/uploads/{{$cart->product->gambar}}" alt="">
                                                <h5>{{$cart->product->nama_barang}}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                Rp. {{number_format($cart->product->harga)}}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                        {{$cart->jumlah}}
                                                </div>
                                            </td>
                                            <td class="shoping__cart__price">
                                                Rp. {{number_format($cart->total)}}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="/delete_from_cart/{{$cart->id}}">
                                                    <span class="icon_close"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__btns">
                            <a href="/" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>continue shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__continue">
                            <div class="shoping__discount">
                                <select name="provinsi" id="provinsi" class="checkout__input provinsi">
                                    <option value="">--Pilih Provinsi--</option>
                                    @foreach ($provinsi->rajaongkir->results as $provinsi)
                                        <option value="{{$provinsi->province_id}}">{{$provinsi->province}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="shoping__discount">
                                <select name="kota" id="kota" class="checkout__input kota">
                                    
                                </select>
                            </div>
                            <div class="checkout__input">
                                <input type="text" class="berat" name="berat" id="berat" placeholder="--Berat--">
                            </div>
                            <div class="shoping__cart__btns">
                                <a href="#" name="updateTotal"
                                class="primary-btn cart-btn update-total"> Update Total </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Cart Total</h5>
                            <ul>
                                <li>Subtotal <span>Rp. <span class="cart-total"> {{($cart_total)}}</span></span></li>
                                <li>Ongkir <span>Rp. <span class="ongkir"> 0</span></span></li>
                                <li>
                                    <input type="hidden" name="grand_total" class="grand_total">
                                    Total 
                                    <span>Rp. <span class="grand-total"> </span></span>
                                </li>
                            </ul>
                            <a href="" class="primary-btn proceed_to_checkout">PROCEED TO CHECKOUT</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
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

            $('.update-total').click(function(e){
                e.preventDefault()
                $.ajax({
                    url : '/get_ongkir/' + $('.kota').val() + '/' + $('.berat').val(),
                    success : function(data){
                        data = JSON.parse(data);
                        grandtotal = parseInt(data.rajaongkir.results[0].costs[0].cost[0].value) + parseInt($('.cart-total').text())

                        $('.ongkir').text(data.rajaongkir.results[0].costs[0].cost[0].value)
                        $('.grand-total').text(grandtotal)
                        $('.grand_total').val(grandtotal)
                    }
                });
            });

            $('.proceed_to_checkout').click(function(e){
                e.preventDefault()
                $.ajax({
                    url : '/checkout_orders',
                    method : 'POST',
                    data : $('.form-cart').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    success : function(){
                        location.href = '/checkout'
                    }
                })
            })
        });
    </script>
@endpush