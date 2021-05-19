@extends('layouts.app')

@section('content')
 <link rel="stylesheet" href="/css/select2.css">
    <script src="/js/select2.js"></script>
    
    <div class="container">
        <div class="jumbotron">
            <h1>Miasi</h1>
        </div>
        <div class="col-sm-9">
           @foreach ($posts as $post)
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">
                        Autor <a href="{{route('user.show', $post->user) }}" >{{ $post->user['username'] }} </a>
                        {{ $post->title }}
                        @if ($post->friends()->count() > 0)
                            <small>
                                with
                                @foreach ($post->friends as $tag)
                                    {{ $tag->user2->username }},
                                @endforeach
                            </small>
                        @endif
<!--                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('post.show', [$post->id]) }}">Show Post</a></li>
                                    <li><a href="{{ route('post.edit', [$post->id]) }}">Edit Post</a></li>
                                    <li>
                                        <a href="#" onclick="document.getElementById('delete').submit()">Delete Post</a>
                                        {!! Form::open(['method' => 'DELETE', 'id' => 'delete', 'route' => ['post.delete', $post->id]]) !!}
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            </div>-->
                            <div class="pull-right">
                            <a href="{{ route('post.show', [$post->id]) }}">Zobacz post</a>
                        </div>
                    </h3>
                  </div>
                  <div class="panel-body">
                    {{ $post->body }}
                    @if ($post->image != null)
                        <img src="/images/{{ $post->image }}" alt="Image" width="100%" height="600">
                    @endif
                    <br />
                    Kategoria: <div class="badge">{{ $post->category['name'] }}</div>
                    <br />
                    Miasto: <div class="badge">{{ $post->city }}</div>
                  </div>
                    

                </div>
            @endforeach
        </div>
    
        <div class="col-sm-3">
            @foreach ($categories as $category)
                <a href="{{ route('category.showAll', [$category->name]) }}" class="badge">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
    <script type="text/javascript">
        $('.select2-class').select2();
    </script>
@endsection
