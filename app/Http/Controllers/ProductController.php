<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Blade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['list']);
        $this->middleware('auth:api')->only(['store','update','destroy']);
    }

    public function list()
    {
        $categories = category::all();
        return view('product.index',compact('categories'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::with('category')->get();

        return response()->json([
            'success' => true,
            'data'=>$products
        ]);
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
            'id_kategori' => 'required',
            'nama_barang' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp',
            'deskripsi' => 'required',
            'harga' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();

        if($request->has('gambar')){
            $gambar = $request->file('gambar');
            $nama_gambar = time().rand(1,9).'.'.$gambar->getClientOriginalExtension();
            $gambar->move('uploads',$nama_gambar);
            $input['gambar'] = $nama_gambar;
        }

        $product = product::create($input);

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $validator = Validator::make($request->all(),[
            'id_kategori' => 'required',
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();

        if($request->has('gambar')){
            File::delete('uploads/'.$product->gambar);
            $gambar = $request->file('gambar');
            $nama_gambar = time().rand(1,9).'.'.$gambar->getClientOriginalExtension();
            $gambar->move('uploads',$nama_gambar);
            $input['gambar'] = $nama_gambar;
        } else{
            unset($input['gambar']);
        }

        $product -> update($input);

        return response()->json([
            'massage' => 'success',
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        File::delete('uploads/'.$product->gambar);
        $product -> delete();

        return response()->json([
            'success' => true,
            'massage' => 'success'
        ]);
    }
}
