<h1>Posts List Pagination</h1>
<table class="table mt-4" border="1">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
              </tr>
            </thead>
            <tbody>
            @foreach ( $posts as $post) 
            <tr >
                <td>{{ $post['id'] }}</th> <!-- //we can acceess object as an array in laravel by magic method -->
                <td>{{ $post->title }}</td>
                <td>{{ $post->user ? $post->user->name : 'Not found' }}</td>
                <td>{{ $post->created_at->format('Y-m-d') }}</td>
              </tr>
              @endforeach

            </tbody>
          </table>

          <span>
              {{$posts->links()}}
          </span>

          <style>
              .w-5{
                  display:none
              }
          </style>