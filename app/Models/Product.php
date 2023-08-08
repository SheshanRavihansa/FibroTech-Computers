<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'image',
        'stock',
        'type',
        'status',
        'price',
        'discount',
        'is_featured',
        'cat_id',
        'sub_cat_id',
        'brand_id',
    ];

    public function parent_cat()
    {
        return $this->hasOne(Category::class, 'id', 'cat_id');
    }
    public function sub_cat()
    {
        return $this->hasOne(Category::class, 'id', 'sub_cat_id');
    }
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
}
