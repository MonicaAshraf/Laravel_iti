<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];


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
}
