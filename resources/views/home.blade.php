@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <!--<img src="{{ Auth::user()->profile_picture }}" alt="">-->
                        Witaj {{ Auth::user()->username }}
                        <div class="pull-right">
                            <a href="{{ route('friend.show', Auth::user()->id) }}">Znajomi</a>
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <div>
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">Twoje Ogłoszenia</a></li>
                        <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Komentarze</a></li>
<!--                        <li role="presentation"><a href="#likes" aria-controls="likes" role="tab" data-toggle="tab">Zapisane posty</a></li>-->
                        <li role="presentation"><a href="#offer" aria-controls="offer" role="tab" data-toggle="tab">Moje oferty</a></li>
<!--                        <li role="presentation"><a href="#tag" aria-controls="likes" role="tab" data-toggle="tab">View Tags</a></li>-->
                      </ul>
                        
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active fade in" id="posts">
                            {{ Auth::user()->posts()->count() }} Dodanych ogłoszeń
                            @foreach (Auth::user()->posts as $post)
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h3 class="panel-title">
                                        {{ $post->title }}
                                        <div class="pull-right">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </a>

                                                <ul class="dropdown-menu" role="menu">
                                                    <!--<li><a href="{{ route('post.show', [$post->id]) }}">Pokaż ogłoszenie</a></li>-->
                                                    <li><a href="{{ route('post.edit', [$post->id]) }}">Edytuj ogłoszenie</a></li>
                                                    <li>
                                                        <a href="#" onclick="document.getElementById('deletePost{{$post->id}}').submit()">Usuń ogłoszenie</a>
                                                        {!! Form::open(['method' => 'DELETE', 'id' => 'deletePost' . $post->id, 'route' => ['post.delete', $post->id]]) !!}
                                                        {!! Form::close() !!}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </h3>
                                  </div>
                                  <div class="panel-body">
                                    {{ $post->body }}
                                    <br />
                                    Kategoria: <div class="badge">{{ $post->category->name }}</div>
                                    
                                    @foreach ($post->offers as $offer)
                                        
                                        <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                                            <div class="panel-body">
                                                <div class="tab">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Cena</th>
                                                                <th scope="col">Autor</th>
                                                                <th scope="col">Data dodania</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr scope="row">
                                                                <td>{{ $offer->price }}</td>
                                                                <td><a href="{{route('user.show', $offer->user) }}" >{{ $offer->user->username }} </a><br/></td>
                                                                <td>{{ $offer->created_at }}</td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                    </table>
                                                   
                                                    
                                                    
                                            </div>
                                                </div>
                                        </div>
                                        
                                    @endforeach
                                    
                                    
                                    
                                    
                                  </div>
                                </div>
                            @endforeach
                        </div>
                          
                          
                          
                        <div role="tabpanel" class="tab-pane fade" id="comments">
                            {{ Auth::user()->comments()->count() }} Dodanych komentarzy
                            @foreach (Auth::user()->comments as $comment)
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="col-sm-9">
                                        {{ $comment->comment }}
                                    </div>
                                    <div class="col-sm-3">

                                        <a href="#" onclick="document.getElementById('deleteComment{{$comment->id}}').submit()">Usuń komentarz</a>
                                                        {!! Form::open(['method' => 'DELETE', 'id' => 'deleteComment' . $comment->id, 'route' => ['comment.delete', $comment->id]]) !!}
                                                        {!! Form::close() !!}
                                    </div>
                                  </div>
                                </div>
                            @endforeach
                        </div>
                          
                        <div role="tabpanel" class="tab-pane fade" id="likes">
                            @foreach (Auth::user()->likes as $like)
                                @if ($like->like)
                                    <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <h3 class="panel-title">
                                            Dodano przez {{ $like->post->user->username }}, {{ $like->post->title }}
                                            <div class="pull-right">
                                                
                                                <a href="{{ route('post.show', [$like->post->id]) }}">Show Post</a>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </a>

                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="{{ route('post.show', [$like->post->id]) }}">Show Post</a></li>
                                                        <li><a href="{{ route('post.edit', [$like->post->id]) }}">Edit Post</a></li>
                                                        <li>
                                                            <a href="#" onclick="document.getElementById('deletePost{{$like->post->id}}').submit()">Delete Post</a>
                                                            {!! Form::open(['method' => 'DELETE', 'id' => 'deletePost' . $like->post->id, 'route' => ['post.delete', $like->post->id]]) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </h3>
                                      </div>
                                      <div class="panel-body">
                                        {{ $like->post->body }}
                                        @if ($like->post->image != null)
                                            <img src="/images/{{ $like->post->image }}" alt="Image" width="100%" height="600">
                                        @endif
                                        <br />
                                        Kategoria: <div class="badge">{{ $like->post->category->name }}</div>
                                      </div>
                                      <div class="panel-footer" data-postid="{{ $like->post->id }}">
                                        <a href="#" class="btn btn-link like active-like">Like <span class="badge">{{ $like->post->likes()->where('like', '=', true)->count() }}</span></a>
                                        <a href="#" class="btn btn-link like">Dislike <span class="badge">{{ $like->post->likes()->where('like', '=', false)->count() }}</a>
                                         <a href="{{ route('post.show', [$like->post->id]) }}" class="btn btn-link">Comment</a>
                                      </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                          
                        <div role="tabpanel" class="tab-pane fade" id="tag">
                            @foreach (Auth::user()->friends1 as $friend)
                                @foreach ($friend->user1->posts as $post)
                                    @foreach ($post->friends as $tag)
                                        @php
                                            $user = App\User::find($tag->id);
                                        @endphp
                                        @if ($user->id == Auth::user()->id)
                                            <div class="panel panel-default">
                                              <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    {{ $post->title }} 
                                                    <div class="pull-right">
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                                <span class="caret"></span>
                                                            </a>

                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="{{ route('post.show', [$post->id]) }}">Show Post</a></li>
                                                                <li><a href="{{ route('post.edit', [$post->id]) }}">Edit Post</a></li>
                                                                <li>
                                                                    <a href="#" onclick="document.getElementById('postdelete{{$post->id}}').submit()">Delete Post</a>
                                                                    {!! Form::open(['method' => 'DELETE', 'id' => 'postdelete'. $post->id, 'route' => ['post.delete', $post->id]]) !!}
                                                                    {!! Form::close() !!}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </h3>
                                              </div>
                                              <div class="panel-body">
                                                {{ $post->body }}
                                                <br />
                                                Category: <div class="badge">{{ $post->category->name }}</div>
                                              </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </div>
                          
                          
                          <div role="tabpanel" class="tab-pane fade" id="offer">
                            @foreach (Auth::user()->offers as $offer)
                            <div class="panel panel-default"><br/>
                                            <div class="panel-body">
                                                <div >

                                                    
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Post</th>
                                                                <th scope="col">Cena</th>
                                                                <th scope="col">Autor</th>
                                                                <th scope="col">Data dodania</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr scope="row">
                                                                <td><a href="{{route('post.show', $offer->post) }}" >{{ $offer->post->title }} </a></td>
                                                                <td>{{ $offer->price }}</td>
                                                                <td><a href="{{route('user.show', $offer->user) }}" >{{ $offer->user->username }} </a><br/></td>
                                                                <td>{{ $offer->created_at }}</td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                            @endforeach
                        </div>
                          
                          
                          
                          
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
