<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orderdetail;
use Blade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['list','dikonfirmasi_list','dikemas_list','dikirim_list','diterima_list','selesai_list']);
        $this->middleware('auth:api')->only(['store','update','destroy','ubah_status']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = order::with('member')->get();

        return response()->json([
            'data'=>$orders
        ]);
    }

    public function list()
    {
        return view('pesanan.index');
    }
    public function dikonfirmasi_list()
    {
        return view('pesanan.dikonfirmasi');
    }
    public function dikemas_list()
    {
        return view('pesanan.dikemas');
    }
    public function dikirim_list()
    {
        return view('pesanan.dikirim');
    }
    public function diterima_list()
    {
        return view('pesanan.diterima');
    }
    public function selesai_list()
    {
        return view('pesanan.selesai');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_member' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();
        $order = order::create($input);

        for ($i=0; $i < count($input['id_product']); $i++) { 
            orderdetail::create([
                'id_order' => $order['id'],
                'id_product' => $input['id_product'][$i],
                'jumlah' => $input['jumlah'][$i],
                'total' => $input['total'][$i]
            ]);
        }
        

        return response()->json([
            'data' => $order
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        return response()->json([
            'data' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        $validator = Validator::make($request->all(),[
            'id_member' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();
        $order -> update($input);

        orderdetail::where('id_order',$order['id'])->delete();

        for ($i=0; $i < count($input['id_product']); $i++) { 
            orderdetail::create([
                'id_order' => $order['id'],
                'id_product' => $input['id_product'][$i],
                'jumlah' => $input['jumlah'][$i],
                'total' => $input['total'][$i]
            ]);
        }

        return response()->json([
            'massage' => 'success',
            'data' => $order
        ]);
    }

    public function ubah_status(request $request, order $order)
    {
        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'massage' => 'success',
            'data' => $order
        ]);
    }

    public function baru()
    {
        $orders = order:: with('member')->where('status','baru')->get();

        return response()->json([
            'data'=>$orders
        ]);
    }

    public function dikonfirmasi()
    {
        $orders = order:: with('member')->where('status','dikonfirmasi')->get();

        return response()->json([
            'data'=>$orders
        ]);
    }

    public function dikemas()
    {
        $orders = order:: with('member')->where('status','dikemas')->get();

        return response()->json([
            'data'=>$orders
        ]);
    }

    public function dikirim()
    {
        $orders = order:: with('member')->where('status','dikirim')->get();

        return response()->json([
            'data'=>$orders
        ]);
    }

    public function diterima()
    {
        $orders = order:: with('member')->where('status','diterima')->get();

        return response()->json([
            'data'=>$orders
        ]);
    }

    public function selesai()
    {
        $orders = order:: with('member')->where('status','selesai')->get();

        return response()->json([
            'data'=>$orders
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        $order -> delete();

        return response()->json([
            'massage' => 'success'
        ]);
    }
}
