<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
class PostController extends Controller
{
    public function index()
    {
    //STATIC_DATA V1
      //  $posts=[
      //    ['id' =>1, 'title' => 'Laravel', 'post_creator' =>'monica', 'created_at' =>'2022-04-16 2:10:00'],
      //    ['id' =>2, 'title' => 'Php', 'post_creator' =>'asmaa', 'created_at' =>'2022-04-16 3:10:00'],
      //    ['id' =>3, 'title' => 'Java', 'post_creator' =>'hadeer', 'created_at' =>'2022-04-16 4:10:00']
      //  ];

    //DATABASE V2:
     $posts= Post::all();//select * from posts; --> return object
      //dd($posts);//global helper method for debugging
      

    //  $filteredPosts=Post::where('title','java');//select * from posts where title = 'java';
    //  dd($filteredPosts);//return object of Eloquent\Builder --> because it don't know end of sql query
    
    $filteredPosts=Post::where('title','java')->get();//get() --> represent end of query
    //dd($filteredPosts);//return object of Eloquent\Collection


       return view('posts.index',[
         'posts' => $posts,
         ]);//1st parameter:"view",2nd parameter "data" :array[] ---> ('key' of foreach in view => value variable name of array)
    }

    public function create()
    {
      $users = User::all();
      //dd($users);
      return view('posts.create', ['users'=> $users]);
    }

    public function store()
    {
      //get the request data 
         // $data = $_POST;
         $data = request()->all(); //global helper method == $_POST , return array
       //dd($data);

      //store the request data into the database
        // insert into posts ('hello')
        Post::create([
          'title' => $data['title'],
          'description' => $data['description'],
        ]);


      //redirection to /posts  
      return redirect()->route('posts.index');//take alias name
    }

    public function show($postId){
    //STATIC_DATA V1:
      // $posts=[
      //   ['id' =>1, 'title' => 'Laravel', 'post_creator' =>'monica', 'created_at' =>'2022-04-16 2:10:00'],
      //   ['id' =>2, 'title' => 'Php', 'post_creator' =>'asmaa', 'created_at' =>'2022-04-16 3:10:00'],
      //   ['id' =>3, 'title' => 'Java', 'post_creator' =>'hadeer', 'created_at' =>'2022-04-16 4:10:00']
      // ];
    
    //DATABASE V2 :
    //  $post = Post::where('id',$postId)->get();//select * from posts where id = 'postId';
    //  dd($post);//return object of Eloquent\Collection

    // $post = Post::where('id',$postId)->first(); 
    // dd($post);//return object of Eloquent\Post

    $post = Post::find($postId);//shorthand way
    //dd($post);

   // return view('posts.show',['post'=> $posts[$postId-1]]);
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