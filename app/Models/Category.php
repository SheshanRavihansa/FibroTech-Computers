<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'is_parent',
        'parent_id',
    ];

    public function parent_info()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function sub_cats()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('status', 'active');
    }

    public static function getAllMainsWithSubcats()
    {
        return Category::with('sub_cats')->where('is_parent', 1)->where('status', 'active')->orderBy('name', 'ASC')->get();
    }
}
