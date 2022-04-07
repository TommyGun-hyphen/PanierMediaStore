<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable  = ['order_id', 'product_id', 'price', 'quantity'];
    public function extras(){
        return $this->belongsToMany(Extra::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
