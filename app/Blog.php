<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{

    protected $guarded = [];

    public function setSlugAttribute($title)
    {
        $this->attributes['slug'] = $this->uniqueSlug($title);
    }

    private function uniqueSlug($title)
    {
        $slug = Str::slug($title, '-');
        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        return $newCount > 0 ? "$slug->$newCount" : $slug;
    }

    public function tag()
    {
        return $this->belongsToMany('App\Tag', 'blogtags');
    }
    public function cat()
    {
        return $this->belongsToMany('App\Category', 'blogcategories');
    }

    public function user()
    {
        return $this->belongsTo('App\User')->select('id', 'fullName', 'profilePic');
        // return $this->belongsTo('App\User')->select('id', 'fullName', 'profilePic');
    }
}
