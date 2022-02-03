<?php
 
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
  
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index',compact('posts'));
    }
    public function create()
    {
        /// menampilkan halaman create
        $categories = Category::get();
        $tags = Tag::get();
        return view('posts.create',compact('categories','tags'));
    }
  
    public function store(StorePostRequest $request)
    {
        $input = $request->all();
  
        if ($image = $request->file('thumbnail')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['thumbnail'] = "$profileImage";
        }
    
        $post = Post::create($input);
        $post->tags()->attach(request('tags'));
        /// insert setiap request dari form ke dalam database via model
        /// jika menggunakan metode ini, maka nama field dan nama form harus sama
         
        /// redirect jika sukses menyimpan data
        return redirect()->route('posts.index')
                        ->with('success','Post created successfully.');
    }
  
    public function show(Post $post)
    {
        /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
        /// berdasarkan id yang dipilih
        /// href="{{ route('posts.show',$post->id) }}
        return view('posts.show',compact('post'));
    }
  
    public function edit(Post $post)
    {
        /// dengan menggunakan resource, kita bisa memanfaatkan model sebagai parameter
        /// berdasarkan id yang dipilih
        /// href="{{ route('posts.edit',$post->id) }}
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }
  
    public function update(UpdatePostRequest $request, Post $post)
    {
         
        /// mengubah data berdasarkan request dan parameter yang dikirimkan
        $input = $request->all();
  
        if ($thumbnail = $request->file('thumbnail')) {
        if($post->thumbnail && file_exists('images/'.$post->thumbnail)){
                $image = Post::find($post->id);
                unlink("images/".$image->thumbnail);
          }
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($destinationPath, $profileImage);
            $input['thumbnail'] = "$profileImage";
        }else{
            unset($input['thumbnail']);
        }
          $post->update($input);
          
        $post->tags()->sync(request('tags'));
        /// setelah berhasil mengubah data
        return redirect()->route('posts.index')
                        ->with('success','Post updated successfully');
    }
  
    public function destroy(Post $post)
    {
        if($post->thumbnail && file_exists('images/'.$post->thumbnail)){
            $image = Post::find($post->id);
            unlink("images/".$image->thumbnail);
      }
        /// melakukan hapus data berdasarkan parameter yang dikirimkan
        $post->delete();
  
        return redirect()->route('posts.index')
                        ->with('success','Post deleted successfully');
    }
   
}