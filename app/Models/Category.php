<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];
    public function subCategories(){
        return $this->hasMany(SubCategory::class, 'category', 'id');
    }
}
