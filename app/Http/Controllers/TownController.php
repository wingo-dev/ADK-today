<?php

namespace App\Http\Controllers;

use App\Models\Town;
use App\Http\Requests\Town\StoreRequest;
use App\Http\Requests\Town\UpdateRequest;
use App\Models\County;
use Illuminate\Http\Request;

class TownController extends Controller
{
    public function index()
    {
        $towns = Town::orderBy('name')->paginate(10);
        $counties = County::all();
        return view('towns.index',compact('towns','counties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::all();
        return view('towns.create',compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Town::create($data);
        createFlashMessage('Town Created Successfully','success');
        return redirect()->route('towns.index');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $town = Town::findOrFail($id);
        return view('towns.show',compact('town'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $town = Town::findOrFail($id);
        $counties = County::all();
        return view('towns.create',compact('town','counties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,$id)
    {
        $town = Town::findOrFail($id);
        $data = $request->validated();
        $town->update($data);
        createFlashMessage('Town Updated Successfully','success');
        return redirect()->route('towns.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $town = Town::findOrFail($id);
        $town->delete();
        createFlashMessage('Town Deleted Successfully','success');
        return route('towns.index');
    }
    public function getTowns(Request $request)
    {
        $towns = Town::where('county_id',$request->county_id)->orderBy('name')->get();
        return response()->json($towns);
    }
    public function search(Request $request)
    {
        $data =  $request->validate([
            'county_id' => 'nullable|string'
        ]);
        $query           = Town::query();
        if (isset($data['county_id']) && $data['county_id'] != '') {
            $query->where('county_id', $data['county_id']);
        }
        $towns = $query->orderBy('name')->paginate(10);
        $counties = County::all();
        return view('towns.index', compact('towns','counties'));
    }
}

