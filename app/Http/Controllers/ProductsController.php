<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        return view('pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'img' => 'required'
        ]);
        $data = $request->all(); // Ambil semua request
        if ($request->file('img')) {
            $extension = $request->file('img')->getClientOriginalExtension();
            $newName = $request->name. '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->storeAs('img', $newName, 'public');
            $data['img'] = $newName;
            $data['price'] = (Int)str_replace(['Rp. ','.'], '', $request->price);
            // dd($data['price']);
        }

        Products::create($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {

        return view('pages.product.edit',compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {

        // stock belum diupdate
        // Validasi input
        // $request->validate([
        //     'product_name' => 'required|string|max:255',
        //     'price' => 'required|numeric',
        //     'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        // ]);

        $data = $request->all();

        // Periksa jika ada gambar baru diunggah
        if ($request->file('img')) {
            if ($product->img) {
                Storage::delete('public/image/' . $product->img);
            }

            // Simpan gambar baru
            $extension = $request->file('img')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->storeAs('img', $newName, 'public');

            // Simpan nama gambar baru
            $data['img'] = $newName;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {

        if ($product->image) {
            Storage::delete('public/image/' . $product->image);
        }

        $product->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }

}