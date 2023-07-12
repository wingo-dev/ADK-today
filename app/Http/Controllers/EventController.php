<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Models\Category;
use App\Models\County;
use App\Models\Tag;
use App\Models\User;
use App\Utils\Common\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string',
            'start_date' => 'nullable|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'nullable|date_format:Y-m-d|after_or_equal:start_date'
        ]);
        $data = $request->all();
        
        $auth_user = auth()->user();
        
        $searchableArray = [
            'title',
        ];
        
        $query = Event::query();
        $query->whereLike($searchableArray, $request->search);
        if (isset($data['county_id'])) {
            $query->where('county_id', $data['county_id']);
        }
        if (isset($data['category_id'])) {
            $query->where('category_id', $data['category_id']);
        }
        if (isset($data['start_date'], $data['end_date'])) {
            $start_date = Carbon::parse($data['start_date'])->toDateString();
            $end_date   = Carbon::parse($data['end_date'])->toDateString();
            $query->where(function($q) use ($start_date, $end_date) {
                $q->whereBetween('start_date', array($start_date, $end_date))
                  ->orWhereBetween('end_date', array($start_date, $end_date));
            });
        } elseif (isset($data['start_date'])) {
            $query->where('start_date', '>=', $data['start_date']);
        } elseif (isset($data['end_date'])) {
            $query->where('end_date', '<=', $data['end_date']);
        }
        if ( !($auth_user->role == UserRoles::SUPER_ADMIN || $auth_user->role == UserRoles::ADMIN) ) {
            $query->where('vendor_id', auth()->id());
        }
        
        $events = $query->paginate(10);
        
        $categories = Category::orderBy('name')->get();
        $counties = County::orderBy('name')->get();
        
        return view('events.index', compact('events', 'categories', 'counties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = County::all();
        $vendors  = User::where('role', UserRoles::VENDOR)->get();
        $tags     = Tag::all();
        $categories = Category::all();
        return view('events.create', compact('counties', 'vendors', 'tags','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        
        $imageBasename = Str::random(10);
        if (isset($data['image'])) {
            $image = $request->file('image');

            $imageName = $imageBasename . "." . $image->extension();

            $image->move(public_path(), $imageName);
            
            $data['image']  = $imageName;
            
            if ( isset($data['image_name']) && file_exists(public_path($data['image_name'])) ) {
                unlink(public_path($data['image_name']));
            }
        } elseif (isset($data['image_name'])) {
            $data['image'] = $data['image_name'];
            
            /*if ( file_exists(public_path($data['image_name'])) ) {
                $oldName = pathinfo(public_path($data['image_name']), PATHINFO_FILENAME);
                $cloneImage = str_replace($oldName, $imageBasename, $data['image_name']);
                
                Storage::copy(public_path($data['image_name']), public_path($cloneImage));
                
                $data['image'] = $cloneImage;
            }*/
        }
        
        $thumbBasename = Str::random(10);
        if (isset($data['thumbnail'])) {
            $thumbnail = $request->file('thumbnail');

            $thumbnailName = $thumbBasename . "." . $thumbnail->extension();

            $thumbnail->move(public_path(), $thumbnailName);
            
            $data['thumbnail']  = $thumbnailName;
            
            if ( isset($data['thumbnail_name']) && file_exists(public_path($data['thumbnail_name'])) ) {
                unlink(public_path($data['thumbnail_name']));
            }
        } elseif (isset($data['thumbnail_name'])) {
            $data['thumbnail'] = $data['thumbnail_name'];
            
            /*if ( file_exists(public_path($data['thumbnail_name'])) ) {
                $oldName = pathinfo(public_path($data['thumbnail_name']), PATHINFO_FILENAME);
                $cloneThumbnail = str_replace($oldName, $thumbBasename, $data['thumbnail_name']);
                
                Storage::copy(public_path($data['thumbnail_name']), public_path($cloneThumbnail));
                
                $data['thumbnail'] = $cloneThumbnail;
            }*/
        }
        
        if (isset($data['is_free'])) {
            $data['cost'] = 0;
        } else {
            $data['is_free'] = 0;
        }
        
        $tag_ids = $data['tags'];
        unset($data['tags']);
        
        unset($data['image_name']);
        unset($data['thumbnail_name']);
        
        $event = Event::create($data);
        $event->tags()->sync($tag_ids);
        createFlashMessage('Event Created Successfully', 'success');
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $event = Event::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('events.show', compact('event','categories','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $user = auth()->user();
        if ($user->role == UserRoles::VENDOR && $event->vendor_id != $user->id) {
            createFlashMessage('You are not allowed to edit this event', 'danger');
            return redirect()->route('events.index');
        }
        $selected_town = $event->town;
        $counties = County::all();
        $tags = Tag::all();
        $selected_tags = $event->tags->pluck('id');
        $vendors  = User::where('role', UserRoles::VENDOR)->get();
        $categories = Category::all();

        return view('events.create', compact('event', 'counties', 'selected_town', 'vendors', 'tags', 'selected_tags','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $event = Event::findOrFail($id);
        $user = auth()->user();
        if ($user->role == UserRoles::VENDOR && $event->vendor_id != $user->id) {
            createFlashMessage('You are not allowed to edit this event', 'error');
            return redirect()->route('events.index');
        }
        $data = $request->validated();
        $tag_ids = $data['tags'];
        unset($data['tags']);
        $event->tags()->sync($tag_ids);
        
        if (isset($data['image'])) {
            $random = Str::random(10);
            $image = $request->file('image');
            $imageName = $random . "." . $image->extension();
            $image->move(public_path(), $imageName);
            $data['image']  = $imageName;
            
            /*if ( $event->image != "storage/defaults/event.png" && file_exists(public_path($event->image)) ) {
                unlink(public_path($event->image));
            }*/
            if ( isset($data['image_name']) && file_exists(public_path($data['image_name'])) ) {
                unlink(public_path($data['image_name']));
            }
        }
        if (isset($data['thumbnail'])) {
            $random = Str::random(10);
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = $random . "." . $thumbnail->extension();
            $thumbnail->move(public_path(), $thumbnailName);
            $data['thumbnail']  = $thumbnailName;
            
            /*if ( $event->thumbnail != "storage/defaults/event.png" && file_exists(public_path($event->thumbnail)) ) {
                unlink(public_path($event->thumbnail));
            }*/
            if ( isset($data['thumbnail_name']) && file_exists(public_path($data['thumbnail_name'])) ) {
                unlink(public_path($data['thumbnail_name']));
            }
        }
        unset($data['image_name']);
        unset($data['thumbnail_name']);
        
        if (isset($data['is_free'])) {
            $data['cost'] = 0;
        } else {
            $data['is_free'] = 0;
        }
        $event->update($data);
        createFlashMessage('Event Updated Successfully', 'success');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        createFlashMessage('Event Deleted Successfully', 'success');
        return route('events.index');
    }
    
    public function cloneEvent($id)
    {
        $event = Event::findOrFail($id);
        $user = auth()->user();
        if ($user->role == UserRoles::VENDOR && $event->vendor_id != $user->id) {
            createFlashMessage('You are not allowed to clone this event', 'danger');
            return redirect()->route('events.index');
        }
        $selected_town = $event->town;
        $counties = County::all();
        $tags = Tag::all();
        $selected_tags = $event->tags->pluck('id');
        $vendors  = User::where('role', UserRoles::VENDOR)->get();
        $categories = Category::all();
        
        $isClone = true;

        return view('events.create', compact('isClone', 'event', 'counties', 'selected_town', 'vendors', 'tags', 'selected_tags','categories'));
    }
    
    public function detail($id)
    {
        $event = Event::findOrFail($id);
        return view('events.detail', compact('event'));
    }
}
