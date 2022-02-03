@extends('template')
@section('title', $post->title)

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Show Post</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('posts.index') }}"> Back</a>
        </div>
        </div>
      </div>
    <div class="row">
    <div class="col-md-12">
    <div class="table-responsive">
    <table class="table table-bordered" style="border:1px solid darkgrey;">
        <tbody>
            <tr>
                <th class="table-active">Title</th>
                <td>{{ $post->title }}</td>
            </tr>
            <tr>
                <th class="table-active">Description</th>
                <td>{{ $post->description }}</td>
            </tr>
            <tr>
                <th class="table-active">Categories</th>
                <td>{{ $post->category->name }}</td>
            </tr>
            <tr>
                <th class="table-active">Tags</th>
                <td>
                @foreach($post->tags as $tag)
                <a href="#">{{ $tag->name}}</a>

                @endforeach
                </td>
            </tr>
            <tr>
                <th class="table-active">Thumbnail</th>
                <td><img src="/images/{{ $post->thumbnail }}" width="400px"></td>
            </tr>
            <tr>
                <th class="table-active">Slug</th>
                <td>{{ $post->slug }}</td>
            </tr>

        </tbody>


    </table>
    </div>
    </div>
    </div>
</main>
@endsection
