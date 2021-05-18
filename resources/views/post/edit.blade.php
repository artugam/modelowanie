@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/select2.css">
    <script src="/js/select2.js"></script>
    <div class="container">
        <div class="col-sm-6 col-sm-offset-3">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('success') }}
                </div>
            @endif
            {!! Form::model($post, ['method' => 'PUT', 'files' => true, 'route' => ['post.update', $post->id]]) !!}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>Nazwa ogłoszenia:</p>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Podaj tytuł']) }}
                            @if ($errors->has('title'))
                                <small class="text-danger">{{ $errors->first('title') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <p>Zdjęcie:</p>
                          <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <p>Opis:</p>
                            {{ Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Dodaj opis']) }}
                            @if ($errors->has('body'))
                                <small class="text-danger">{{ $errors->first('body') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <p>Kategorie:</p>
                          <select class="form-control" name="category">
                              @foreach ($categories as $category)
                                  <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <input type="text" name="city" class="form-control" placeholder="Miasto">
                            @if ($errors->has('city'))
                                <small class="text-danger">{{ $errors->first('city') }}</small>
                            @endif
                        </div>
<!--                        <div class="form-group">
                            <select class="form-control select2-class" name="tags[]" multiple>
                                @foreach (Auth::user()->friends as $friend)
                                    <option value="{{ $friend->id }}">{{ $friend->user2->username }}</option>
                                @endforeach
                            </select>
                        </div>-->
                        <input type="submit" value="Edytuj ogłoszenie" class="btn btn-primary btn-block">
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <script type="text/javascript">
        $('.select2-class').select2();
    </script>
@endsection
