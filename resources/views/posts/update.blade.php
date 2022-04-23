@extends('layouts.app')
@section('title')Update @endsection
@section('content')
    you are updated successfully :) 

    <div class="text-center">
            <a href="{{ route('posts.index') }}" class="mt-4 btn btn-success">All Posts</a>
        </div>
        <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Update At</th>
              </tr>
            </thead>
            <tbody>
             
            <tr >
                <td>{{ $oldData['id'] }}</th> <!-- //we can acceess object as an array in laravel by magic method -->
                <td>{{ $oldData->title }}</td>
                <td>{{ $oldData->user ? $oldData->user->name : 'Not found' }}</td>
                <td>{{ $oldData->created_at->format('Y-m-d') }}</td>
                <td>{{ $oldData->updated_at->format('Y-m-d') }}</td>
                </tr>
             

            </tbody>
          </table>
@endsection