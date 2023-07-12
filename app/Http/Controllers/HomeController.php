<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\County;
use App\Models\Event;
use App\Models\Tag;
use App\Models\Town;
use App\Utils\Common\UserRoles;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
// dd($request->all());
        $request->validate([
            'search' => 'nullable|string',
            'start_date' => 'sometimes|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'sometimes|date_format:Y-m-d|after_or_equal:start_date'
        ]);
        $query           = Event::query()->whereRaw('TIMESTAMP(`end_date`,`end_time`) >= ?', [now()->toDateTimeString()]);
        $data            = $request->all();

        if (isset($data['tags']) && $data['tags'] != []) {
            $query->whereHas('tags', function ($q) use ($data) {
                $q->whereIn('tags.id', $data['tags']);
            });
        }
        if(isset($data['start_date'],$data['end_date'])){
            $start_date = Carbon::parse($data['start_date'])->toDateString();
            $end_date   = Carbon::parse($data['end_date'])->toDateString();
           $query->where(function($q) use ($start_date,$end_date){
            $q->whereBetween('start_date',array($start_date,$end_date))
            ->orWhereBetween('end_date',array($start_date,$end_date));
           });
        }else{
            $date = Carbon::parse(now())->toDateString();
              $query->where(function($q) use ($date){
                $q->whereBetween('start_date',array($date,$date))
                ->orWhereBetween('end_date',array($date,$date));
              });
        }


        $towns      =  collect([]);
        $tags      =  collect([]);

        if(isset($data['county_id'])){
            $query->where('county_id',$data['county_id']);
            $towns = Town::where('county_id',$data['county_id'])->orderBy('name')->get();

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
            $query->where('category_id',$data['category_id']);
            $tags = Tag::where('category_id',$data['category_id'])->orderBy('name')->get();
        }
        if(isset($data['is_free']) && (int) $data['is_free'] == 1){
            $query->where('is_free',1);
        }
        $searchable_array = [
            'title',
        ];
        $events = $query->whereLike($searchable_array, $request->search)->paginate(10);

        $counties = County::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $all_events = Event::orderBy('title')->get();
        
        // Get random banner
        $tmpBanners = scandir(public_path('img/banner'));
        $banners = array();
        foreach ($tmpBanners as $banner) {
            if ( is_file(public_path('img/banner/'.$banner)) ) {
                $banners[] = $banner;
            }
        }
        $banner = $banners[array_rand($banners, 1)];
        
        return view('home', compact('events','counties','categories','all_events','towns','tags','banner'));
        // return view('home');
    }
    public function land()
    {
        $user = auth()->user();
        if(!$user){
            return redirect()->route('home');
        }
        elseif($user->role == UserRoles::USER){
            return redirect()->route('home');
        }
        else{
            return redirect()->route('dashboard');
        }
    }
}
