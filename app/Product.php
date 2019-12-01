<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label','price','quantity'
    ];

    public $timestamps = false;

    public function user_products()
    {
        return $this->hasMany(\App\UserProduct::class);
    }
}
