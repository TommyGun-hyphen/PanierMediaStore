<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Category;
class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'name', 'slug'];

    public function category(){
        return $this->belongsTo(Category::class, 'category');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
