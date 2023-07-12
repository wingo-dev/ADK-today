<?php


namespace App\Utils;

use App\Models\Payment;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Helpers
{
    public static function generateSlug($modal, $title, $extra_length = 6)
    {

        $str = 'abcdefghijklmnopqrstuvwxyz';
        do {
            $slug = Str::slug($title) . '-' . substr(str_shuffle($str), 0, $extra_length);
            $exists = $modal::where('slug', $slug)->exists();
        } while ($exists);
        return $slug;
    }

    public static function usersFilter($query,$search,$filters)
    {
        if (isset($filters['role']) && $filters['role'] != '') {
            $query->where('role', $filters['role']);
        }
        if (isset($filters['status']) && $filters['status'] != '') {
            $query->where('status', $filters['status']);
        }

        $searchable_array = [
            'name',
            'title',
            'organization',
        ];
        return $query->whereLike($searchable_array, $search)->paginate(10);
    }
}
