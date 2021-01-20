@if($child_answer->answer)
        <li class="panel-body">
            <div class="list-group">
                <div class="list-group-item">
                    <h3>
                        @if($child_answer->author)
                            {{$child_answer->author['name']}}
                        @else
                            Anonymous
                        @endif
                    </h3>
                    <p>
                        {{ $child_answer->created_at->format('M d,Y \a\t h:i a') }}
                    </p>
                </div>
                <div class="list-group-item">
                    <p>{{ $child_answer->body }}</p>
                    <form method="post" action="/answer/add">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="on_comment" value="{{ $child_answer->id }}">
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
                        @foreach($child_answer->answer as $ChildAnswer)
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
@endif
