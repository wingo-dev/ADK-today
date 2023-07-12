<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Jobs\SendEmailJob;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(10);
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Category::create($data);
        createFlashMessage('Category Created Successfully','success');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.create',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,$id)
    {
        $category = Category::findOrFail($id);
        $data = $request->validated();
        $category->update($data);
        createFlashMessage('Category Updated Successfully','success');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        createFlashMessage('Category Deleted Successfully','success');
        return route('categories.index');
    }
    public function recommendCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        $details = [
            'user_name' => auth()->user()->name,
            'category_name' => $data['name'],
            'type'          => 'category-suggestion'
        ];
        dispatch(new SendEmailJob($details));

        createFlashMessage('Category Recommended Successfully','success');
        return redirect()->route('events.index');
    }
}
