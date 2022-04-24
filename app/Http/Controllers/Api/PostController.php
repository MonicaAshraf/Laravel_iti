<?php

namespace App\Http\Controllers\Api;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
class PostController extends Controller
{
    public function index()
    {
        $posts=Post::all();
        return PostResource::collection($posts);
    }

    public function show($postId)
    {
        $post=Post::find($postId);

        return new PostResource($post);
        // return [
        //     'id' => $post->id,
        //     'title' => $post->title,
        //     'description' => $post->description,
        //     'user_id' => $post->user_id,
            
        // ];
    }

    public function store(StorePostRequest $request)
    {
        $data = request()->all();

        $post=Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['postCreator'],
          //  'slug' =>Str::slug($request->input('title')),
            
          ]);
        //   return  [
        //     'id' => $post->id,
        //     'title' => $post->title,
        //     'description' => $post->description,
        //     'user_id' => $post->user_id,
            
        // ];

        return new PostResource($post);
    }
}
