@extends('layouts.app')
@section('title')

@endsection
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
        <div class="list-group">
            <div class="list-group-item">
                    <form action="{{url('search_parsed_tag')}}" method="post">
                        @csrf

                        <select name="tag_id[]" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->parsed_tag}}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Search">
                    </form>
                    <div class="">
                        @foreach( $posts as $post )

                            <div class="list-group">
                                <div class="list-group-item">
                                    <p><a href="{{ url('show_parsed_post/'.$post->id) }}">{{ $post->title }}<br></a>
                                        <strong>Tags:</strong>
                                        @foreach($post->parsedTags as $tag)
                                            <label class="label label-info">{{ $tag->parsed_tag }}</label>
                                        @endforeach

                                    </p>
                                    <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
@endsection


