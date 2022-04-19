@extends('layouts.app')

@section('title')Index @endsection

@section('content')
        <div class="text-center">
            <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>
        </div>
        <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- dd   $posts  =>contains object of collation -->
            @foreach ( $posts as $post)  
            <!-- dd    $post  =>contains object of Post  -->

            <!-- after create join relation  : -->
             <!-- dd $post->user => return object of user model -->
                 <!-- then we can reach to the user data by using this object : such as name -->
                      <!-- dd $post->user->name => return user name -->
              <!-- wrong naming function to solve it use foreignkey -->
                 <!-- dd $post->someTest => return null before foreignkey      -->

              <tr>
                <td>{{ $post['id'] }}</th> <!-- //we can acceess object as an array in laravel by magic method -->
                <td>{{ $post->title }}</td>
                <td>{{ $post->user ? $post->user->name : 'Not found' }}</td>
                <td>{{ $post->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('posts.show', ['post' => $post->id ]) }}" class="btn btn-info">View</a>
                    <a href="{{ route('posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Edit</a>
                    <form method="post" action="{{ route('posts.destroy', ['post' => $post['id']]) }}">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger"  onclick="return confirm('Are you sure for Delete?')">Delete</button>
                    </form>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
@endsection
 