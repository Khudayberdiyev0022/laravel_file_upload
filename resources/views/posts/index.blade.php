@extends('layouts.front')
@section('content')
  <div class="mt-3">
    <div class="d-flex justify-content-between align-items-center">
      <h1>Posts</h1>
      <a href="{{ route('posts.create') }}">Create</a>
    </div>
    <table class="table table-striped">
      <tr>
        <th>Name</th>
        <th>Body</th>
        <th>Images</th>
        <th>Action</th>
      </tr>
      @foreach($posts as $post)
        <tr>
          <td>{{ $post->name }}</td>
          <td>{{ $post->body }}</td>
          <td>
            @foreach($post->images as $image)
            <img src="{{ asset("storage/{$image->path}"  ?? '') }}" alt="" width="50" height="50">
            @endforeach
          </td>
          <td>
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-warning">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
@endsection
