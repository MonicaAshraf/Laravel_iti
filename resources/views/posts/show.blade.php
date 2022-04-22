@extends('layouts.app')
@section('title')Show @endsection

@section('content')
        <table class="table mt-4">
            <thead>
              <tr align="center">
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
              </tr>
            </thead>
            <tbody>
           
              <tr align="center">
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post->user ? $post->user->name : 'Not found' }}</td>
                <td>{{ $post['created_at']->format('Y-m-d') }}</td>
              </tr>
             
            </tbody>
          </table>
        <div class="header">
          @include('posts.comment')
        </div>

        
        <table class="table mt-4">
            <thead>
              <tr align="center">
                <th scope="col">User</th>
                <th scope="col">Comment</th>
                <th scope="col">Created at</th>
              </tr>
            </thead>
            <tbody>
                  @foreach($comments as $comment)
                    <tr >
                      <td>{{ $comment->user->email }}</td>
                      <td>{{ $comment['commentContent'] }}</td> 
                      <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                    </tr>
                  @endforeach
            </tbody>
        </table>

        
@endsection