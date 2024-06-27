@extends('layouts.front')
@section('content')
  <div class="mt-2">
    <h1>Categories Create</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group mb-3">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $category->title) }}">
      </div>
      <div class="form-group mb-3">
        <label for="icon">Icon</label>
        <input type="file" name="icon" id="icon" class="form-control" value="{{ old('icon', $category->icon) }}">
      </div>
      <div>
        <img src="{{ asset("storage/{$category->icon->path}") }}" alt="" width="50">
      </div>
      <div class="d-flex justify-content-end float-right">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
