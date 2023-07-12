<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\County;
use App\Models\Event;
use App\Models\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function homeSearch(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string'
        ]);
        $query           = Event::query();
        $data            = $request->all();
        if (isset($data['tags']) && $data['tags'] != []) {
            $query->whereHas('tags', function ($q) use ($data) {
                $q->whereIn('tags.id', $data['tags']);
            });
        }
        if(isset($data['start_date'],$data['end_date'])){
            $start_date = Carbon::parse($data['start_date']);
            $end_date = Carbon::parse($data['end_date']);

            $query->whereBetween('start_date',[$data['start_date'],$data['end_date']]);
        }
        if(isset($data['county_id'])){
            $query->where('county_id',$data['county_id']);
        }
        if(isset($data['town_id'])){
            $query->where('town_id',$data['town_id']);
        }
        if(isset($data['vendor_id'])){
            $query->where('vendor_id',$data['vendor_id']);
        }
        if(isset($data['event_id'])){
            $query->where('id',$data['event_id']);
        }
        if(isset($data['category_id'])){
            $query->whereRelation('tags','category_id',$data['category_id']);
        }
        $searchable_array = [
            'title',
        ];
        $events = $query->whereLike($searchable_array, $request->search)->paginate(10);
        $counties = County::all();
        $towns = Town::all();
        $categories = Category::all();
        $all_events = Event::all();
        return view('home.events', compact('events','counties','towns','categories','all_events'));
    }
}
