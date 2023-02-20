<?php


namespace App\Models;
use App\Models\Auth\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
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
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function transactions()
    {
        return $this->hasMany(Product::class);
    }
}
