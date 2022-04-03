<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SubCategory;
use App\Models\ProductImage;
use App\Models\ExtraGroup;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'price', 'price_old', 'sub_category', 'image_url'];
    public function subCategory(){
        return $this->belongsTo(SubCategory::class, 'sub_category');
    }
    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function extragroups(){
        return $this->belongsToMany(ExtraGroup::class);
    }


    //SCOPE
    function scopeFilter($q){
        if(request('price_max') && is_numeric(request('price_max')) && request('price_max') > 0){
            $q->where('price', '<', request('price_max'));
        }
        if(request('category')){
            
            $excluded = [];

            if(request('subcategory')){
                $q->whereIn('sub_category', request('subcategory'));

                $subcats = SubCategory::whereIn('id', request('subcategory'))->get();
                foreach($subcats as $subcat){
                    $excluded[] = $subcat->category()->first()->id;
                }
                //dd($excluded);

            }
            $allowed = array_diff(request('category'), $excluded);

            $q->orWhereIn('sub_category', function($query) use($allowed){
                $query->select('id')->from('sub_categories')->whereIn( 'category', $allowed );
            });
        }
        if(request('subcategory')){
            $q->whereIn('sub_category', request('subcategory'));
        }
        return $q;
    }
}
