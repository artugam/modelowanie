@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-6 col-sm-offset-3">
            @if (Session::has('success'))
                          <div class="alert alert-success">
                              <a href="#" class="close" data-dismiss="alert">&times;</a>
                              {{ Session::get('success') }}
                          </div>
                      @endif
            <div class="panel panel-default" style="margin: 0; border-radius: 0;">
              <div class="panel-heading">
                <h3 class="panel-title">
                    {{ $post->title }},
                    @if ($post->friends()->count() > 0)
                        <small>
                            with
                            @foreach ($post->friends as $tag)
                                {{ $tag->user2->username }},
                            @endforeach
                        </small>
                    @endif
                    <div class="pull-right">
                        <a href="{{ url('/post') }}">Ogłoszenia</a>
                    </div>
                </h3>
              </div>
              <div class="panel-body">
                {{ $post->body }}
                @if ($post->image != null)
                    <img src="/images/{{ $post->image }}" alt="Image" width="100%" height="600">
                @endif
                <br />
                <div class="badge">
                    {{ $post->category->name }}
                </div>
              </div>
<!--              <div class="panel-footer" data-postid="{{ $post->id }}">
                  @if (Auth::check())
                      @php
                          $i = Auth::user()->likes()->count();
                          $c = 1;
                          $likeCount = $post->likes()->where('like', '=', true)->count();
                          $dislikeCount = $post->likes()->where('like', '=', false)->count();
                      @endphp
                      @foreach (Auth::user()->likes as $like)
                          @if ($like->post_id == $post->id)
                              @if ($like->like)
                                  <a href="#" class="btn btn-link like active-like">Zapisz post <span class="badge">{{ $likeCount }}</span></a>
                                  <a href="#" class="btn btn-link like">Usuń z zapisanych <span class="badge">{{ $dislikeCount }}</span></a>
                              @else
                                  <a href="#" class="btn btn-link like">Zapisz post <span class="badge">{{ $likeCount }}</span></a>
                                  <a href="#" class="btn btn-link like active-like">Usuń z zapisanych <span class="badge">{{ $dislikeCount }}</span></a>
                              @endif
                              @break
                          @elseif ($i == $c)
                              <a href="#" class="btn btn-link like">Zapisz post <span class="badge">{{ $likeCount }}</span></a>
                              <a href="#" class="btn btn-link like">Usuń z zapisanych <span class="badge">{{ $dislikeCount }}</span></a>
                          @endif
                          @php
                              $c++;
                          @endphp
                      @endforeach
                      @if ($i == 0)
                          <a href="#" class="btn btn-link like">Zapisz post <span class="badge">{{ $likeCount }}</span></a>
                          <a href="#" class="btn btn-link like">Usuń z zapisanych <span class="badge">{{ $dislikeCount }}</span></a>
                      @endif
                  @else
                      <a href="{{ url('login') }}" class="btn btn-link">Zapisz post <span class="badge">{{ $likeCount }}</span></a>
                      <a href="{{ url('login') }}" class="btn btn-link">Usuń z zapisanych <span class="badge">{{ $dislikeCount }}</span></a>
                  @endif
                  <a href="#" class="btn btn-link">Komentarze</a>
              </div>-->
            </div>
            @foreach ($post->comments as $comment)
                <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                  <div class="panel-body">
                      <div class="col-sm-9">
                          {{ $comment->comment }}
                      </div>
                      <div class="col-sm-3 text-right">
                          <small>Autor {{ $comment->user->username }}
                              
                              <a href="#" onclick="document.getElementById('delete').submit()">  X</a>
                                                        {!! Form::open(['method' => 'DELETE', 'id' => 'delete', 'route' => ['post.delete', $post->id]]) !!}
                                                        {!! Form::close() !!}
                        
                                                        
                          </small>
                      </div>
                      
                      
                  </div>
                </div>
            @endforeach
            
            
            <div class="panel-body">
                
                    <div>
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active btn-primary" style="background-color: #262525;"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Dodaj komentarz</a></li>
                        <li role="presentation" class="btn-primary" style="background-color: #262525;"><a href="#join" aria-controls="posts" role="tab" data-toggle="tab">Złóż ofertę</a></li>
                      </ul>
     
                      <div class="tab-content">
                          
                        <div role="tabpanel" class="tab-pane active fade in" id="comments">
                            @if (Auth::check())
                <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                  <div class="panel-body">
                      <form action="{{ url('/comment') }}" method="POST" style="display: flex;">
                          {{ csrf_field() }}
                          <input type="hidden" name="post_id" value="{{ $post->id }}">
                          <input type="text" name="comment" placeholder="" class="form-control" style="border-radius: 0;">
                          <input type="submit" value="Dodaj komentarz" class="btn btn-primary" style="border-radius: 0;">
                      </form>
                      @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <a href="#" class="close" data-dismiss="alert">&times;</a>
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      {{ $error }}
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                  </div>
                </div>
            @endif
                        </div>   
                          
                        <div role="tabpanel" class="tab-pane fade" id="join">
                            @if (Auth::check())
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                      <form action="{{ url('/offer') }}" method="POST">
                                          {{ csrf_field() }}
                                          <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                                <h2>Złóż ofertę</h2>
                                                <label>Cena (zł)</label>
                                                <input type="text" name="price" placeholder="" class="form-control" style="border-radius: 0;"><br>
                                            </div>  
                                            <input type="submit" value="Złóż ofertę" class="btn btn-success btn-block" heistyle="border-radius: 0;">
                                      </form>
                                      @if (count($errors) > 0)
                                          <div class="alert alert-danger">
                                              <a href="#" class="close" data-dismiss="alert">&times;</a>
                                              <ul>
                                                  @foreach ($errors->all() as $error)
                                                      {{ $error }}
                                                  @endforeach
                                              </ul>
                                          </div>
                                      @endif
                                      
                                  </div>
                                </div>
                            @endif
            
                        </div>                        
                      </div>
                    </div>
                </div>

        </div>
    </div>
@endsection
