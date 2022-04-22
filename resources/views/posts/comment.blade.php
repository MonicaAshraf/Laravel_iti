@section('comment')

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>

@endif

@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>

@endif

<h2>Comments</h2>
<form method="post" action="{{ route('create.comment',['postId'=>$post['id']]) }}">
@csrf
  <div class="mb-3">
    <label  class="form-label">Add your comment</label>
    <input type="text" class="form-control" name="comment" >
  </div>
  <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
                <select name="postCreator" id="exampleFormControl" class="form-control">
                   @foreach($users as $user)
                       <option value="{{$user->id}}">{{$user->name}}</option>
                   @endforeach

                </select>
            </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@show