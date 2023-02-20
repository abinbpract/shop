<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected static function boot()
    {
        parent::boot();
        static::saving(function($model){
            $model->user_id= auth()->user()->id;
        });
    }
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function party()
    {
        return $this->belongsTo(Party::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
