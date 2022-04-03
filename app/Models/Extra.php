<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ExtraGroup;
use App\Models\Product;


class Extra extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'price', 'extra_group_id'];
    public function extraGroup(){
        return $this->belongsTo(ExtraGroup::class);
    }
    
}
