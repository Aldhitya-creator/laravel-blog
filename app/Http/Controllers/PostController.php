<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create',[
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $input = $request->all();

        if (request()->file('thumbnail')) {
            $thumbnail = request()->file('thumbnail');
            $thumbnailUrl = $thumbnail->storeAs("images/posts", time().".{$thumbnail->extension()}");
        } else{
            $thumbnailUrl = null;
        }
        $input['thumbnail'] = "$thumbnailUrl";

        $post = Post::create($input);
        $post->tags()->attach(request('tags'));
         
        return redirect()->route('posts.index')
            ->with('success','Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    { 
        $input = $request->all();

        if ($thumbnail = $request->file('thumbnail')) {
            if($post->thumbnail && file_exists('img/'.$post->thumbnail)){
                $image = Post::find($post->id);
                unlink("img/".$image->thumbnail);
            }
            
            $destinationPath = 'img/';
            $profileImage = date('YmdHis') . "." . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($destinationPath, $profileImage);
            $input['thumbnail'] = "$profileImage";
        }else{
            unset($input['thumbnail']);
        }

        $post->update($input);
        $post->tags()->sync(request('tags'));
         
        return redirect()->route('posts.show',$post->slug)
            ->with('success','Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->thumbnail && Storage::exists($post->thumbnail)){
            Storage::delete($post->thumbnail);
        }

        $post->tags()->detach();
        $post->delete();
  
        return redirect()->route('posts.index')
            ->with('success','Post deleted successfully!');
    }
}