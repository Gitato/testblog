@extends('layouts.app')
@section('title')
    @if($post)
        {{ $post->title }}
        @if(!Auth::guest() && ($post->author_id == Auth::user()->id))
            <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->id)}}">Edit Post</a></button>
        @endif
    @else
        Page does not exist
    @endif
@endsection
@section('title-meta')
    <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
    <p>Views:{{$post->view_count}}</p>
@endsection
@section('content')
    @if($post)
        <div class="list-group">
            <div class="list-group-item">
                <label>
            {!! $post->body !!}
                </label>
                <br>
                <br>
            <div style="text-align: right">
            <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>
            <p>Views:{{$post->view_count}}</p>
            </div>
            </div>
        </div>
        <div>
            <h2>Leave a comment</h2>
        </div>
            <div class="panel-body">
                <form method="post" action="/comment/add">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="on_post" value="{{ $post->id }}">
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    <div class="form-group">
                        <textarea required="required"
                                  placeholder="Enter comment here"
                                  name = "body"
                                  class="form-control"></textarea>
                    </div>
                    <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
                </form>
            </div>
        @endif
        <div>
            @if($comments)
                <ul style="list-style: none; padding: 0">
                    @foreach($comments as $comment)
                        <li class="panel-body">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <h3>
                                        @if($comment->author)
                                        {{$comment->author->name}}
                                        @else
                                        Anonymous
                                        @endif
                                    </h3>
                                    <p>
                                        {{ $comment->created_at->format('M d,Y \a\t h:i a') }}
                                    </p>
                                </div>
                                <div class="list-group-item">
                                    <p>{{ $comment->body }}</p>
                                    <div class="panel-body">
                                        <form method="post" action="/answer/add">
                                            @csrf
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="on_comment" value="{{ $comment->id }}">
                                            <input type="hidden" name="id" value="{{ $post->id }}">
                                            <div class="form-group">
                                                <textarea required="required"
                                                          placeholder="Enter comment here"
                                                          name = "body"
                                                          class="form-control"></textarea>
                                            </div>
                                            <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
                                        </form>
                                        @foreach($comment->answer as $answer)
                                            <ul style="list-style: none; padding: 0">
                                                <li class="panel-body">
                                                    <div class="list-group">
                                                        <div class="list-group-item">
                                                            <h3>
                                                                @if($answer->author)
                                                                {{$answer->author['name']}}
                                                                @else
                                                                Anonymous
                                                                @endif
                                                            </h3>
                                                            <p>
                                                                {{ $answer->created_at->format('M d,Y \a\t h:i a') }}
                                                            </p>
                                                        </div>
                                                        <div class="list-group-item">
                                                            <p>{{ $answer->body }}</p>
                                                            <form method="post" action="/answer/add">
                                                                @csrf
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="hidden" name="on_comment" value="{{ $answer->id }}">
                                                                <input type="hidden" name="id" value="{{ $post->id }}">
                                                                <div class="form-group">
                                                                <textarea required="required"
                                                                          placeholder="Enter comment here"
                                                                          name = "body"
                                                                          class="form-control"></textarea>
                                                                </div>
                                                                <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
                                                            </form>
                                                            <ul style="list-style: none; padding: 0">
                                                                @foreach($answer->ChildAnswer as $ChildAnswer)
                                                                    <div>
                                                                        <div>
                                                                        <a href="" class="spoiler_links" id="{{$ChildAnswer->id}}">Показать комментарий</a>
                                                                        <div class="spoiler_body">
                                                                    @include('answer',['child_answer'=>$ChildAnswer])
                                                                        </div>
                                                                        </div>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
@endsection
