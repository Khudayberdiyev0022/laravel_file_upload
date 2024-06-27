@extends('layouts.front')
@section('content')
  <div class="mt-3">
   <div class="d-flex justify-content-between align-items-center">
     <h1>Categories</h1>
     <a href="{{ route('categories.create') }}">Create</a>
   </div>
    <table class="table table-striped">
      <tr>
        <th>Title</th>
        <th>Icon</th>
        <th>Action</th>
      </tr>
      @foreach($categories as $category)
        <tr>
          <td>{{ $category->title }}</td>
          <td>
            <img src="{{ asset("storage/{$category->icon->path}"  ?? '') }}" alt="" width="50" height="50">
          </td>
          <td>
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-warning">Edit</a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST">
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
