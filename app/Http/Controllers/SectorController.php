<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectorRequest;
use App\Http\Requests\UpdateSectorRequest;
use App\Models\Sector;
use App\Models\Utils;

class SectorController extends Controller
{
    private $title = "Sector";
    private $action = "sector";
    private $route = "sector";
    /**
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Sector::all();
        $columns = Utils::entityColumns( 'sectors' );
        $data = ['columns' => $columns, 'data' => $products, 'title' => $this->title, 'action' => $this->action, 'route' => $this->route];
        return view('crud', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sector.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectorRequest $request)
    {
        //dd($request);
        Sector::create($request->validated());
        return redirect()->route('sector.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sector $sector)
    {
        return redirect()->route('sector.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sector $sector)
    {
        return view('sector.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectorRequest $request, Sector $sector)
    {
        //dd($request->validated());
        $sector->update($request->validated());
        return redirect()->route('sector.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sector $sector)
    {
        $sector->delete();
        return redirect()->route('sector.index');
    }
}
