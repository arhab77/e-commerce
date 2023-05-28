<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\category;
use App\Models\order;
use App\Models\payment;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $categories = category::all();
        $products = product::all();
        return view('home.index',compact('categories','products'));
    }

    public function add_to_cart(Request $request)
    {
        $input = $request->all();
        Cart::create($input);
    }

    public function delete_from_cart(Cart $cart)
    {
        
        $cart->delete();
        return redirect('/cart');
    }

    public function product($id_categories)
    {
        $products = product::where('id_kategori',$id_categories)->get();
        return view('home.product',compact('products'));
    }

    public function cart()
    {
        if(!Auth::guard('webmember')->user()){
            return redirect('/login_member');
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 65e3c7b2ff45aee5fdbed3dfbe2f7efa"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } 

        $provinsi = json_decode($response);

        $carts = Cart::where('id_member',Auth::guard('webmember')->user()->id)->where('is_checkout',0)->get();
        $cart_total = Cart::where('id_member',Auth::guard('webmember')->user()->id)->where('is_checkout',0)->sum('total');

        return view('home.cart',compact('carts', 'provinsi','cart_total'));
    }

    public function get_kota($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 65e3c7b2ff45aee5fdbed3dfbe2f7efa"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
    }

    public function get_ongkir($destination, $weight)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=387&destination=" . $destination . "&weight=" . $weight . "&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 65e3c7b2ff45aee5fdbed3dfbe2f7efa"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
    }

    public function checkout_orders(Request $request)
    {
        $id = DB::table('orders')->insertGetId([
            'id_member' => $request->id_member,
            'invoice' => date('ymds'),
            'total_harga' => $request->grand_total,
            'status' => 'Baru',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        for ($i=0; $i < count($request->id_produk); $i++) { 
            DB::table('orders_details')->insert([
                'id_order' => $id,
                'id_product' => $request->id_produk[$i],
                'jumlah' => $request->jumlah[$i],
                'total' => $request->total[$i],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        Cart::where('id_member',Auth::guard('webmember')->user()->id)->update([
            'is_checkout' => 1
        ]);
    }

    public function checkout()
    {
        $orders = order::where('id_member',Auth::guard('webmember')->user()->id)->first();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 65e3c7b2ff45aee5fdbed3dfbe2f7efa"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } 

        $provinsi = json_decode($response);

        return view('home.checkout',compact('orders','provinsi'));
    }

    public function payments(Request $request)
    {
        payment::create([
            'id_order' => $request->id_order,
            'id_member' => Auth::guard('webmember')->user()->id,
            'jumlah' => $request->jumlah,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => "",
            'detail_alamat' => $request->detail_alamat,
            'status' => 'MENUNGGU',
            'no_rekening' => $request->no_rekening,
            'atas_nama' => $request->atas_nama,
        ]);

        return redirect('/orders');
    }

    public function orders()
    {
        if(!Auth::guard('webmember')->user()){
            return redirect('/login_member');
        }
        $orders = order::where('id_member',Auth::guard('webmember')->user()->id)->get();
        $payments = payment::where('id_member',Auth::guard('webmember')->user()->id)->get();

        return view('home.orders', compact('orders','payments'));
    }

    public function pesanan_selesai(order $order)
    {
        $order->status = 'Selesai';
        $order->save();

        return redirect('/orders');
    }

    public function shop($id_product)
    {
        $product = product::find($id_product);

        return view('home.shop',compact('product'));
    }

    public function contact()
    {
        return view('home.contact');
    }
}
