<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
