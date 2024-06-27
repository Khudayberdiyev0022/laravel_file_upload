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
        </tr>
      @endforeach
    </table>
  </div>
@endsection
