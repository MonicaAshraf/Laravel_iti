<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\StorePostRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use App\Jobs\PruneOldPostsJob;
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


    PruneOldPostsJob::dispatch();

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

    public function store(StorePostRequest $request)//object from StorePostRequest , called type hinting 
    {   
     // $dt= Carbon::now();
     // $createTime=$dt->toDateString();
      
      //$dt = new Carbon('2012-01-31');
     //$dt->roundUnit('month', 2)->format('Y-m-d');  // 2012-03-01


  // request()->validate([
  //   'title' =>['required' , 'min:3'],
  //   'description' =>['required', 'min:5'],
  // ],[
  //   'title.required' =>'My Customized Message' ,
  //   'title.min'=>'My Customizing the min rules',
  // ]);

      //get the request data 
         // $data = $_POST;
         $data = request()->all(); //global helper method == $_POST , return array
      //  dd($data);


      //  $createdAt = Carbon::parse();
      //  $dt=$createdAt->format('M d Y');

      //store the request data into the database
        // insert into posts ('hello')

        
         $user_id=$data['postCreator'];
         $allUsers=User::find($user_id);
         //dd( $allUsers);        
        if($allUsers != null){
           Post::create([
          'title' => $data['title'],
          'description' => $data['description'],
          'user_id' => $data['postCreator'],
          // 'slug' => SlugService::createSlug(Post::class ,'slug' , $request->title)
          'slug' =>Str::slug($request->input('title')),
          
        ]);
      //redirection to /posts  
      return redirect()->route('posts.index');//take alias name

        }//end_if
        else{
          return 'User not exist';
        }
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
    // dd($post);
      $users=User::all();
    $comments=$post->comments->all();
    //dd($comments);
   return view('posts.show',['post'=> $post,'comments'=>$comments,'users'=>$users]);
    }


    public function edit($postId)
    {
      // $posts=[
      //   ['id' =>1, 'title' => 'Laravel', 'post_creator' =>'monica', 'created_at' =>'2022-04-16 2:10:00'],
      //   ['id' =>2, 'title' => 'Php', 'post_creator' =>'asmaa', 'created_at' =>'2022-04-16 3:10:00'],
      //   ['id' =>3, 'title' => 'Java', 'post_creator' =>'hadeer', 'created_at' =>'2022-04-16 4:10:00']
      // ];

      $post = Post::find($postId);
      //dd($post , 'in edit ');
      return view('posts.edit',['post'=> $post]);
    }


    public function update(StorePostRequest $request ,$postId)
    {
      $oldData = Post::find($postId); 
      $newData = request()->all();
      $oldData->title =$newData['title'];
      $oldData->description =$newData['description'];
      $oldData->save();
      //dd($oldData , 'in update ' , $postId);
      return view('posts.update',['oldData'=>$oldData]);
    }

    public function destroy($postId)
    {
      $rowDeleted = Post::find($postId)->delete();
      return redirect()->back();

     
        //return redirect()->back()->with(['success'=>'Posts deleted successfully']);

    }



//Pagination function
    public function page()
    {
      $data=Post::paginate(100);
      return view('list',['posts'=>$data]);
    }


    public function addComment(Request $request,$postId){

      $post=Post::find($postId);
     
      $comment=$post->comments()->create([
          'commentContent'=>$request->input('comment'),
          'user_id'=>$request->input('postCreator'),
      ]);
     if($comment){
      return redirect()->back()->with(['success'=>'Comment is added successfully']);
     }else{
      return redirect()->back()->with(['error'=>'Comment failed to add']);
     }
      
    }
}