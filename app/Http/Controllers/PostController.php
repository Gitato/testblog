<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Http\Request;
use App\Events\PostHasViewed;

class PostController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::with('category')->orderBy('created_at','desc')->paginate(15);
        $title= 'Latest Posts';
        $tags=Tag::all();
//        $categories = Category::all();
//        $tags = Tag::all();
//        dd($posts[0]->tags[0]->tag);
        return view('home')->withPosts($posts)->withTitle($title)->withTags($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        $post= new Post();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->category_id = $request->get('category_id');
        $post->author_id = $request->get('author_id');
        $post->save();

        $input = explode(',', $request->tag);
        foreach ($input as $tag){
        $tags=Tag::firstOrCreate(['tag'=>$tag],['tag'=>$tag]);
        $post->tags()->attach($tags);
        }

        return redirect('home')->withMessage('Post published successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        $comments=$post->comments;
        event(new PostHasViewed($post));

        return view('posts.show')
            ->withPost($post)
            ->withComments($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        if($post->author_id==Auth::user()->id) {
            return view('posts.edit', compact('post'));
        }
        else
        {
            return redirect('home')->withErrors('you have not sufficient permissions');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request,$id)
    {
        $post=Post::find($id);
        $post->body=$request->get('body');
        $post->title=$request->get('title');
        $post->category_id = $request->get('category_id');

        $post->tags()->detach();

        $input = explode(',', $request->tag);
        foreach ($input as $tag){
            $tags=Tag::firstOrCreate(['tag'=>$tag],['tag'=>$tag]);
            $post->tags()->attach($tags);
        }
        $post->save();
        return redirect()->route('home')->with('message','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect()->route('home');
    }
    public function favorite()
    {
        $posts=Post::with('category')
            ->orderBy('view_count','desc')
            ->paginate(15);
        $title= 'Favorite Posts';
        return view('home')->withPosts($posts)->withTitle($title);
    }
    public function nocomments()
    {
        $posts=Post::with('category')
            ->has('comments','==','0')
            ->paginate(15);
        $title= 'Posts without comments';
        return view('home')->withPosts($posts)->withTitle($title);
    }

    public function search_category(Request $request)
    {
        $posts=Post::with('category')
            ->where('category_id','=',$request->category_id)
            ->paginate(15);
        $title= 'Posts with selected category';
        return view('home')->withPosts($posts)->withTitle($title);
    }

    public function search_tag(Request $request)
    {
        $posts=Post::with('category')
            ->join('tags_relationship','posts.id','=','tags_relationship.post_id')
            ->join('tags','tags_relationship.tag_id','=','tags.id')
            ->whereIn('tags.id',$request->tag_id)
            ->groupBy('posts.id')
            ->selectRaw("tags.id as tag_id, tags.tag, posts.*")
            ->paginate(15);

        $tags=Tag::all();
        $title= 'Posts with tags';
        return view('home')->withPosts($posts)->withTitle($title)->withTags($tags);
    }

    public function info(){
        phpinfo();
    }

}
