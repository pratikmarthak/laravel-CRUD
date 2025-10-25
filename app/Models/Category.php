<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
