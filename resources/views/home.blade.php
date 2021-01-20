@extends('layouts.app')
@section('title')

    {{$title}}
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <a href="{{url('home')}}">All Posts</a><br>
    <a href="{{url('favorite.posts')}}">Favorite Posts</a><br>
    <a href="{{url('no-comments.posts')}}">Posts without comments</a><br>
    <form action="{{url('search_category')}}">
        @csrf
        <select name="category_id">
            <option value="1">D&D</option>
            <option value="2">WoW</option>
            <option value="3">R6:S</option>
        </select>
        <input type="submit" value="Search">
    </form>
    @if(!empty($tags))
        <form action="{{url('search_tag')}}">
            @csrf
            <select name="tag_id[]" multiple>
                @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->tag}}</option>
                @endforeach
            </select>
            <input type="submit" value="Search">
        </form>

    @else
        <form action="{{url('search_tag')}}">
            @csrf
            <select name="tag_id[]" multiple>
                @foreach($posts as $post)
                    @foreach($post->tags as $tags)
                        <option value="{{$tags->id}}">{{$tags->tag}}</option>
                    @endforeach
                @endforeach
            </select>
            <input type="submit" value="Search">
        </form>
    @endif

    @if ( !$posts->count() )
        There is no post till now. Login and write a new post now!!!
    @else
        <div class="">
            @foreach( $posts as $post )
                <div class="list-group">
                    <div class="list-group-item">
                        <h3><a href="{{ url('show/'.$post->id) }}">{{ $post->title }}</a>
                            <h5> Category: {{$post->category->category}} </h5>
                            <strong>Tags:</strong>
                            @foreach($post->tags as $tag)
                                <label class="label label-info">{{ $tag->tag }}</label>
                            @endforeach

                            @if(!Auth::guest() && ($post->author_id == Auth::user()->id))
                                    <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->id)}}">Edit Post</a></button>
                            @endif
                        </h3>
                        <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
                        <p>Views:{{$post->view_count}}</p>
                    </div>
                    <div class="list-group-item">
                        <article>
                            {!! Str::limit($post->body, $limit = 150, $end = '....... <a href='.url("show/".$post->id).'>Read More</a>') !!}
                        </article>
                    </div>
                </div>
            @endforeach
            {!! $posts->render() !!}
        </div>
    @endif
@endsection

