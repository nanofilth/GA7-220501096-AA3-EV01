<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Utils;

class CategoryController extends Controller
{
    private $title = "Categories";
    private $action = "category";
    private $route = "category";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Category::all();
        $columns = Utils::entityColumns( 'categories' );
        $data = ['columns' => $columns, 'data' => $products, 'title' => $this->title, 'action' => $this->action, 'route' => $this->route];
        return view('crud', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //dd($request);
        Category::create($request->validated());
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //dd($request);
        $category->update($request->validated());
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }
}
