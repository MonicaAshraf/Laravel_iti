<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
       $posts=[
         ['id' =>1, 'title' => 'Laravel', 'post_creator' =>'monica', 'created_at' =>'2022-04-16 2:10:00'],
         ['id' =>2, 'title' => 'Php', 'post_creator' =>'asmaa', 'created_at' =>'2022-04-16 3:10:00'],
         ['id' =>3, 'title' => 'Java', 'post_creator' =>'hadeer', 'created_at' =>'2022-04-16 4:10:00']
       ];
      // dd($posts);//global helper method for debugging
      
       return view('posts.index',[
         'posts' => $posts,
         ]);//1st parameter:"view",2nd parameter "data" :array[] ---> ('key' of foreach in view => value variable name of array)
    }

    public function create(){
      return view('posts.create');
    }

    public function store(){
      return 'we are in the process of storing';
    }

    public function show($postId){
      $posts=[
        ['id' =>1, 'title' => 'Laravel', 'post_creator' =>'monica', 'created_at' =>'2022-04-16 2:10:00'],
        ['id' =>2, 'title' => 'Php', 'post_creator' =>'asmaa', 'created_at' =>'2022-04-16 3:10:00'],
        ['id' =>3, 'title' => 'Java', 'post_creator' =>'hadeer', 'created_at' =>'2022-04-16 4:10:00']
      ];

    return view('posts.show',['post'=> $posts[$postId-1]]);
    }


    public function edit($postId){
      $posts=[
        ['id' =>1, 'title' => 'Laravel', 'post_creator' =>'monica', 'created_at' =>'2022-04-16 2:10:00'],
        ['id' =>2, 'title' => 'Php', 'post_creator' =>'asmaa', 'created_at' =>'2022-04-16 3:10:00'],
        ['id' =>3, 'title' => 'Java', 'post_creator' =>'hadeer', 'created_at' =>'2022-04-16 4:10:00']
      ];
      return view('posts.edit',['post'=> $posts[$postId-1]]);
    }


    public function update($postId){
      return view('posts.update');
    }
}