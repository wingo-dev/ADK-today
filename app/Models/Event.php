<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function town()
    {
        return $this->belongsTo(Town::class);
    }
    public function vendor()
    {
        return $this->belongsTo(User::class);
    }
    public function county()
    {
        return $this->belongsTo(County::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'event_tags');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
Event::retrieved(function ($event) {
    $event->image = $event->image && file_exists(public_path($event->image)) ? $event->image : "storage/defaults/event.png";
    $event->thumbnail = $event->thumbnail && file_exists(public_path($event->thumbnail)) ? $event->thumbnail : "storage/defaults/event.png";
});
