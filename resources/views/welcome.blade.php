@extends('layouts.app')

@section('content')
 <link rel="stylesheet" href="/css/select2.css">
    <script src="/js/select2.js"></script>
    
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">Serwis ogłoszeniowy</h1>
        </div>
         <div class="text-center">
            @foreach ($categories as $category)
                <a href="{{ route('category.showAll', [$category->name]) }}" class="badge">{{ $category->name }}</a>
                @endforeach
        </div> <br/>
     
        <div class="col-sm-9" >
 
           @foreach ($posts as $post)
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title" style="color:white;">
                        Autor:  <a href="{{route('user.show', $post->user) }}" ><b>{{ $post->user['username'] }}</b> </a>
                        Tytuł: <b >{{ $post->title }}</b>
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
                                <a href="{{ route('post.show', [$post->id]) }}"><b>Zobacz post</b></a>
                        </div>
                    </h3>
                      
                  </div>
                    
                  <div class="panel-body">
                      <h5 style=color:black;><b>Treść ogłoszenia:</b></h5> 
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
    
       
    </div>
    <script type="text/javascript">
        $('.select2-class').select2();
    </script>
@endsection
