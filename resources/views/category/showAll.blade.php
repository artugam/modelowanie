@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-6 col-sm-offset-3">
            @foreach ($posts as $post)
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">
                        Created by {{ $post->user->username }}, {{ $post->title }},
                        @if ($post->friends()->count() > 0)
                            <small>
                                with
                                @foreach ($post->friends as $tag)
                                    {{ $tag->user2->username }},
                                @endforeach
                            </small>
                        @endif
                        <div class="pull-right">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('post.show', [$post->id]) }}">Show Post</a></li>
                                    <li><a href="{{ route('post.edit', [$post->id]) }}">Edit Post</a></li>
                                    <li>
                                        @if (Auth::user()->id == $post->user_id) 
                                        <a href="#" onclick="document.getElementById('delete').submit()">Delete Post</a>
                                        {!! Form::open(['method' => 'DELETE', 'id' => 'delete', 'route' => ['post.delete', $post->id]]) !!}
                                        {!! Form::close() !!}
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </h3>
                  </div>
                  <div class="panel-body">
                    {{ $post->body }}
                    @if ($post->image != null)
                        <img src="/images/{{ $post->image }}" alt="Image" width="100%" height="600">
                    @endif
                    <br />
                    Category: <div class="badge">{{ $post->category->name }}</div>
                  </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
