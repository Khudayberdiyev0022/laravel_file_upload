@extends('layouts.front')
@section('content')
  <div class="mt-2">
    <h1>Categories Create</h1>
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $post->name) }}">
      </div>
      <div class="form-group mb-3">
        <label for="body">Body</label>
        <input type="text" name="body" id="body" class="form-control" value="{{ old('body', $post->body) }}">
      </div>
      <div class="form-group mb-3">
        <label for="images">Icon</label>
        <input type="file" name="images[]" multiple id="images" class="form-control" value="{{ old('images', $post->images) }}">
      </div>
      <div>
        @foreach($post->images as $image)
          <img src="{{ asset("storage/{$image->path}") }}" alt="" width="50">
        @endforeach
      </div>
      <div class="d-flex justify-content-end float-right">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
