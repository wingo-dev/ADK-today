<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\StoreRequest;
use App\Http\Requests\Tag\UpdateRequest;
use App\Jobs\SendEmailJob;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('name')->paginate(10);
        $categories = Category::orderBy('name')->get();
        return view('tags.index',compact('tags','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('tags.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Tag::create($data);
        createFlashMessage('Tag Created Successfully','success');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $tag = Tag::findOrFail($id);
        $categories = Category::all();
        return view('tags.show',compact('tag','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $tag = Tag::findOrFail($id);
        $categories = Category::all();
        return view('tags.create',compact('tag','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,$id)
    {
        $tag = Tag::findOrFail($id);
        $data = $request->validated();
        $tag->update($data);
        createFlashMessage('Tag Updated Successfully','success');
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        createFlashMessage('Tag Deleted Successfully','success');
        return route('tags.index');
    }

    public function recommendTag(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);
        $details = [
            'user_name' => auth()->user()->name,
            'tag_name'  => $data['name'],
            'category_name' => Category::find($data['category_id'])->name,
            'type'          => 'tag-suggestion'

        ];
        dispatch(new SendEmailJob($details));
        createFlashMessage('Tag Recommended Successfully','success');
        return redirect()->route('events.index');
    }
    public function recommendTagView()
    {
        $categories = Category::all();
        return view('events.suggest-tag',compact('categories'));
    }
    public function getTags(Request $request)
    {
        $tags = Tag::where('category_id',$request->category_id)->get();
        return response()->json($tags);
    }
    public function search(Request $request)
    {
        $data =  $request->validate([
            'category_id' => 'nullable|string'
        ]);
        $query           = Tag::query();
        if (isset($data['category_id']) && $data['category_id'] != '') {
            $query->where('category_id', $data['category_id']);
        }
        $tags = $query->paginate(10);
        $categories = Category::orderBy('name')->get();
        return view('tags.index', compact('tags','categories'));
    }
}
