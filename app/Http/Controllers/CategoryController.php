<?php

namespace App\Http\Controllers;

use App\Models\category;
use Blade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['list']);
        $this->middleware('auth:api')->only(['store','update','destroy']);
    }

    public function list()
    {
        return view('kategori.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::all();

        return response()->json([
            'success' => true,
            'data'=>$categories
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
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp'
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

        $category = category::create($input);

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $validator = Validator::make($request->all(),[
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();

        if($request->has('gambar')){
            File::delete('uploads/'.$category->gambar);
            $gambar = $request->file('gambar');
            $nama_gambar = time().rand(1,9).'.'.$gambar->getClientOriginalExtension();
            $gambar->move('uploads',$nama_gambar);
            $input['gambar'] = $nama_gambar;
        } else{
            unset($input['gambar']);
        }

        $category -> update($input);

        return response()->json([
            'success' => true,
            'massage' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        File::delete('uploads/'.$category->gambar);
        $category -> delete();

        return response()->json([
            'success' => true,
            'massage' => 'success'
        ]);
    }
}
