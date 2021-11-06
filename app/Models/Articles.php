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

    public static function boot() {

        parent::boot() ;
        self::creating(function($article){
            $article->user()->associate(auth()->user()->id);
            $article->categorie()->associate(request()->categorie);
            
        });

        self::updating(function($article){
            $article->categorie()->associate(request()->categorie);
        }) ;
    }

    public function user() {

        return $this->belongsTo(User::class, 'user_id') ;
    }

    public function categorie() {

        return $this->belongsTo(Categories::class, 'categories_id') ;
    }
}
