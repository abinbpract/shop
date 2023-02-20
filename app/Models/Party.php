<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
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
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
