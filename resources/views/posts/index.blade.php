@extends('template')

@if(isset($category))
    @section('title' ,"Category: $category->name")
@else
    @section('title' ,'All Post')
@endif

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        @if(isset($category))
        <h1 class="h2">POSTS  {{ $category->name }}</h1>
        @else
        <h1 class="h2">POSTS</h1>
        @endif
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="float-end">
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Create Post</a>
            </div>
        </div>
      </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/posts">Posts</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Post
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                        <th width="20px" class="text-center">No</th>
                        <th>Title</th>
                        <th>Categories</th>
                        <th>Tags</th>
                        <th width="280px"class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($posts->count())
                        <tr>
                        @foreach ($posts as $i => $post)
                        <td class="text-center">{{ ++$i }}</td>
                        <td>{{ $post->title }}</td>
                       <td><a href="/posts/categories/{{ $post->category->slug }}"> <i class="bi bi-tag-fill">{{ $post->category->name }}</i></a></td>
                        <td>
								@foreach ($post->tags as $tag)
						        	<a class="primary" href="/posts/tags/{{ $tag->slug }}">#{{ $tag->name }}</a>
						        @endforeach
					    </td>
                        <td class="text-center">
                        <form action="{{ route('posts.destroy',$post->slug) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('posts.show',$post->slug) }}">Show</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('posts.edit',$post->slug) }}">Edit</a>
        
                            @csrf
                            @method('DELETE')
        
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                        </form>
                        </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center"> You Haven't posted anything yet</td>
                        </tr>
                        @endif
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    </main>

@endsection