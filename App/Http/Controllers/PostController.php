<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // A Get request to /api/posts should be resolved by the index() action method.
        return PostResource::collection(Post::latest()->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Update the store() action method to allow us to validate and create a new post.
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required',            
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $post = new Post;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->title, '.', $image->getClientOriginalExtension());
            $destinationPath = public_path('/uploads/posts');
            $imagePath = $destinationPath . '/' . $name;
            $image->move($destinationPath, $name);
            $post->image = $name;
        }

        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return new PostResource($post);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // a GET request to /api/post/id should be resolved by the show() action method
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        /**
         * the update() method in PostController will allow us to modify an existing post
         * This method receives a request and a post id as parameters, then we use route model binding to resolve the id into an instance of a post
         * First, we validate the $request attributes, then we update the title and body fields of the resolved post.
         */
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
        ]);

        $post->update($request->only(['title', 'body']));

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // This method will allow us to remove an existing post
        /**
         * We resolve the Post instance, then delete it and return a 204 response code. 
         */
        $post->delete();

        return response()->json(null, 204);
    }

    public function all()
    {
        return view('landing', [
            'posts' => Post::latest()->paginate(5)
        ]);
    }

    public function single(Post $post)
    {
        return view('single', compact('post'));
    }

}
