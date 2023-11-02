<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\Products;
use App\Models\Utils;

class ProductsController extends Controller
{
    private $title = "Products";
    private $action = "product";
    private $route = "products";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        $columns = Utils::entityColumns( 'products' );
        $data = ['columns' => $columns, 'data' => $products, 'title' => $this->title, 'action' => $this->action, 'route' => $this->route];
        return view('crud', compact('data'));
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
    public function store(StoreProductsRequest $request)
    {
        //dd($request);
        Products::create($request->validated());
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        return view('products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Products $product)
    {
        //dd($request->validated());
        $product->update($request->validated());
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
