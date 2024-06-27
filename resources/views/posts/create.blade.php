@extends('layouts.front')
@section('content')
  <div class="mt-2">
    <h1>Posts Create</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">
      </div>
      <div class="form-group mb-3">
        <label for="body">Body</label>
        <input type="text" name="body" id="body" class="form-control">
      </div>
      <div class="form-group mb-3">
        <label for="images">Images</label>
        <input type="file" name="images[]" id="images" class="form-control" multiple>
      </div>
      <div class="d-flex justify-content-end float-right">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
