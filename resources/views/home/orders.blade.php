@extends('layout.home')

@section('title','Order')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/eshop/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Order</h2>
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
            <div class="row">
                <h3>My Payments</h3>
                <table class="table table-ordered table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nominal Transfer</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($payments as $index => $payments)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$payments->created_at}}</td>
                                <td>Rp. {{number_format($payments->jumlah)}}</td>
                                <td>{{$payments->status}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row" style="margin-top: 50px">
                <h3>My Order</h3>
                <table class="table table-ordered table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>Rp. {{number_format($order->total_harga)}}</td>
                                <td>{{$order->status}}</td>
                                <td>
                                    <form action="/pesanan_selesai/{{$order->id}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_order" value="{{$order->id}}">
                                        <button type="submit" class="btn primary-btn">SELESAI</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection