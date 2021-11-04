<?php

namespace App\Models;

use App\Models\User;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articles extends Model
{
    use HasFactory;

    protected $guarded = [] ; 

    public function user() {

        return $this->belongsTo(User::class, 'user_id') ;
    }

    public function categorie() {

        return $this->belongsTo(Categories::class, 'categories_id') ;
    }
}
