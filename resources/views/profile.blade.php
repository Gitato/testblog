@extends('layouts.app')
@section('title')
    {{ $user->name }}
@endsection
@section('content')
    <div>
        <img src="{{$user->getAvatarsPath($user->id)
        . $user->avatar}}">
        @if(Auth::user()->id === $user->id)
        <form action="{{ route('upload-avatar',['id'=>Auth::user()->id]) }}" class="my-4"
              enctype="multipart/form-data" method="POST">
            @csrf

            <label for="avatar">Загрузить аватар</label>
            <input type="file" name="avatar" id="avatar">
            <input type="submit" class="btn btn-primary" value="Загрузить">
        </form>
            @isset($path)
                <img class="img-fluid" src="{{ asset('/storage/' . $path) }}" alt="">
            @endisset
        @endif
        <ul class="list-group">
            <li class="list-group-item">
                Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
            </li>
            <li class="list-group-item panel-body">
                <table class="table-padding">
                    <style>
                        .table-padding td{
                            padding: 3px 8px;
                        }
                    </style>
                    <tr>
                        <td>Total Posts</td>
                        <td> {{$posts_count}}</td>
                        @if($author && $posts_count)
                            <td><a href="{{ url('/my-all-posts')}}">Show All</a></td>
                        @endif
                    </tr>
                </table>
            </li>
            <li class="list-group-item">
                Total Comments {{$comments_count}}
            </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>Latest Posts</h3></div>
        <div class="panel-body">
            @if(!empty($latest_posts[0]))
                @foreach($latest_posts as $latest_post)
                    <p>
                        <strong><a href="{{ url('show/'.$latest_post->id) }}">{{ $latest_post->title }}</a></strong>
                        <span class="well-sm">On {{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}</span>
                    </p>
                @endforeach
            @else
                <p>You have not written any post till now.</p>
            @endif
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>Latest Comments</h3></div>
        <div class="list-group">
            @if(!empty($latest_comments[0]))
                @foreach($latest_comments as $latest_comment)
                    @if(!empty($latest_comment->posts))
                    <div class="list-group-item">
                        <p>{{ $latest_comment->body }}</p>
                        <p>On {{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                            <p>On post: <a href="{{ url('show/'.$latest_comment->posts->id) }}">{{ $latest_comment->posts->title }}</a></p>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="list-group-item">
                    <p>You have not commented till now. Your latest 5 comments will be displayed here</p>
                </div>
            @endif
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>Latest Answers</h3></div>
        <div class="list-group">
            @if(!empty($latest_comments[0]))
                @foreach($latest_comments as $latest_comment)
                    @if(empty($latest_comment->posts))
                        <div class="list-group-item">
                            <p>{{ $latest_comment->body }}</p>
                            <p>On {{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                            @foreach($latest_comment->answer as $answer)
                                <p>On comment: {{ $answer }}</p>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            @else
                <div class="list-group-item">
                    <p>You have not commented till now. Your latest 5 comments will be displayed here</p>
                </div>
            @endif
        </div>
    </div>
@endsection
