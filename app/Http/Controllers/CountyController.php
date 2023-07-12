<?php

namespace App\Http\Controllers;

use App\Http\Requests\County\StoreRequest;
use App\Http\Requests\County\UpdateRequest;

use App\Models\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    public function index()
    {
        $counties = County::paginate(10);
        return view('counties.index',compact('counties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('counties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        County::create($data);
        createFlashMessage('County Created Successfully','success');
        return redirect()->route('counties.index');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $county = County::findOrFail($id);
        return view('counties.show',compact('county'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $county = County::findOrFail($id);
        return view('counties.create',compact('county'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,$id)
    {
        $county = County::findOrFail($id);
        $data = $request->validated();
        $county->update($data);
        createFlashMessage('County Updated Successfully','success');
        return redirect()->route('counties.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $county = County::findOrFail($id);
        $county->delete();
        createFlashMessage('County Deleted Successfully','success');
        return route('counties.index');
    }
}
