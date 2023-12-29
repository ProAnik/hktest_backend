<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id', 'name'
    ];

    public function children()
    {
        return $this->hasMany(Sector::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Sector::class, 'parent_id');
    }

    public static function getHierarchy($parentId = null)
    {
        $categories = Sector::where('parent_id', $parentId)->get();

        $categories->each(function ($category) {
            $category->children = Sector::getHierarchy($category->id);
        });

        return $categories;
    }
}
