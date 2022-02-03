@extends('template')
@section('title','Edit')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Post</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="float-end">
                <a class="btn btn-secondary" href="{{ route('posts.index') }}"> Back</a>
            </div>
        </div>
      </div>
  
    <form action="{{ route('posts.update',$post->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
 
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">Title:</label>
                    <input type="text" name="title" value="{{ old('title') ?? $post->title }}" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                    @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group mb-3">
                <label for="category_id">category</label>
                <select class="form-control  @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                <option disabled> -- Choose a Category --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $post->category_id  ? 'selected' : ''}}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category_id'))
                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                @endif
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group mb-3">
                    <label class="form-label">Description:</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" style="height:150px" name="description" placeholder="Content">{{ old('description') ?? $post->description }}</textarea>
                    @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group mb-3">
		            <label class="form-label">Thumbnail</label>
                    <div class="row">
                        <div class="col-md-12">
                            @if($post->thumbnail)
                                <img src="/images/{{ old('thumbnail') ?? $post->thumbnail }}" alt="{{ old('thumbnail') ?? $post->thumbnail }}" width="400px" class="img-thumbnail mb-2">
                            @else
                                <p><em>- No Image -</em></p>
                            @endif
                            <input type="file" name="thumbnail" value="{{ old('thumbnail') ?? $post->thumbnail }}" class="form-control @error('thumbnail') is-invalid @enderror" placeholder="thumbnail">
                            @error('thumbnail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
			    </div>
            </div>
         
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group mb-3">
                    <label class="form-label">Slug:</label>
                    <input type="text" name="slug" value="{{ old('slug') ?? $post->slug }}" class="form-control  @error('slug') is-invalid @enderror" placeholder="Title">
                    @if ($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group mb-3">
                <label for="tags">tags</label>
                <select class="form-control select2  @error('tags') is-invalid @enderror" id="tags" name="tags[]" multiple="multiple">
                <option disabled {{ (old('tags') ? '': 'selected')}}> -- Choose a Tags --</option>
                @foreach ($tags as $tag)
                <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('tags'))
                        <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
 
    </form>
</main>
@endsection