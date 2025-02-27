<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category'  => 'required|string|max:255',
            'product'   => 'required|string|max:255',
            'price'     => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::transaction(function () use ($request) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

                Product::create([
                    'thumbnail' => $thumbnailPath,
                    'category'  => $request->category,
                    'product'   => $request->product,
                    'price'     => $request->price,
                ]);
            });

            return redirect()->route('products.index')->with('success', 'Product successfully added.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add product.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category'  => 'required|string|max:255',
            'product'   => 'required|string|max:255',
            'price'     => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::transaction(function () use ($request, $product) {
                if ($request->hasFile('thumbnail')) {
                    // Hapus file lama jika ada
                    Storage::disk('public')->delete($product->thumbnail);
                    $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                } else {
                    $thumbnailPath = $product->thumbnail;
                }

                $product->update([
                    'thumbnail' => $thumbnailPath,
                    'category'  => $request->category,
                    'product'   => $request->product,
                    'price'     => $request->price,
                ]);
            });

            return redirect()->route('products.index')->with('success', 'Product successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::transaction(function () use ($product) {
                Storage::disk('public')->delete($product->thumbnail);
                $product->delete();
            });

            return redirect()->route('products.index')->with('success', 'Product successfully deleted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete product.');
        }
    }
}
