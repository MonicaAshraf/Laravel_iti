<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
//ORM => Object Relation Mapping/Mapper
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
       
    ];

    public function sluggable()
    {
        return[
                'slug'=>[
                    'source' => 'title'
                ]
                ];
    }


    public function user()
    { //function for join relation between users & posts table
        //One To Many (inverse) relation
        return $this->belongsTo(User::class);
    }


    // public function tags()
    // {    //One To Many relation
    //     return $this->hasMany(Tag::class);
    // }


    // public function someTest()
    // { //wrong naming function to solve it use foreignkey 
    //     //function name must be related to the foreign key name
    //     return $this->belongsTo(User::class ,'user_id');
    // }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


   
}
