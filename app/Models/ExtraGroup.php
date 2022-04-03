<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Extra;

class ExtraGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];
    public function extras(){
        return $this->hasMany(Extra::class);
    }
}
