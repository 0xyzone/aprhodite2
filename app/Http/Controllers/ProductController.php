<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('inventory.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $formFileds = $request->validated();
        if ($request->hasFile('image')) {
            $formFileds['image'] = $request->file('image')->store('product/images', 'public');
        }

        Product::create($formFileds);

        return redirect(route('product.index'))->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('inventory.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $formFileds = $request->validated();
        if ($request->hasFile('image')) {
            $formFileds['image'] = $request->file('image')->store('product/images', 'public');
            if($oldImage = $product->image){
                Storage::disk('public')->delete($oldImage);
            }
        }

        $product->update($formFileds);

        return redirect(route('product.index'))->with('success', 'Product updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return back()->with('success', 'Product deleted successfully');
    }

    public function destroyImage(Product $product)
    {
        Storage::disk('public')->delete($product->image);

        $product['image'] = null;

        $product->save();

        return back()->with('success', 'Image removed successfully.');
    }
}
