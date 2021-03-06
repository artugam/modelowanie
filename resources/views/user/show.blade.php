@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="color:white;" class="panel-title">
                        <img src="{{ $user->profile_picture }}" alt="">
                        <b> {{ $user->username }}</b>
                        <div class="pull-right" data-friendid="{{ $user->id }}">
                            @if (Auth::check())
                                @php
                                    $i = Auth::user()->friends()->count();
                                    $c = 1;
                                @endphp
                                @foreach (Auth::user()->friends as $user_1)
                                    @if ($user_1->user2->id == $user->id)
                                    <a href="#" class="btn-link" ><b>Remove Friend</b></a>
                                        @break
                                    @elseif ($i == $c)
                                    <a href="#" class="btn-link"><b>Add Friend</b></a>
                                    @endif
                                    @php
                                        $c++;
                                    @endphp
                                @endforeach
                                @if ($i == 0)
                                <a href="#" class="btn-link"><b>Add Friend</b></a>
                                @endif
                            @endif
                            <a href="{{ route('friend.show', $user->id) }}" class="btn-link"><b>View Friends</b></a>
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <div>
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">Og??oszenia u??ytkownika</a></li>
                        <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Komentarze</a></li>
                      </ul>
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active fade in" id="posts">
                            {{ $user->posts()->count() }} Posts created
                            @foreach ($user->posts as $post)
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h3 style="color:white;" class="panel-title">
                                        <b> {{ $post->title }} </b>
                                        <div class="pull-right">
                                            <div class="dropdown">
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
                                            </div>
                                        </div>
                                    </h3>
                                  </div>
                                  <div class="panel-body">
                                    {{ $post->body }}
                                    <br />
                                    Category: <div class="badge">{{ $post->category['name'] }}</div>
                                  </div>
                                </div>
                            @endforeach
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="comments">
                            {{ $user->comments()->count() }} Comments created
                            @foreach ($user->comments as $comment)
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="col-sm-9">
                                        {{ $comment->comment }}
                                    </div>
                                    <div class="col-sm-3">
                                        <small><a href="{{ route('post.show', [$comment->post->id]) }}">View Post</a></small>
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
