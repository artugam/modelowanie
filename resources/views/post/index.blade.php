@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/select2.css">
    <script src="/js/select2.js"></script>
    <div class="container">
        <div class="col-sm-9">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('success') }}
                </div>
            @endif
            <form method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <input type="text" name="title" class="form-control" placeholder="Podaj tytuł">
                            @if ($errors->has('title'))
                                <small class="text-danger">{{ $errors->first('title') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                          <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <textarea name="body" rows="8" cols="80" class="form-control" placeholder="Opis ogłoszenia"></textarea>
                            @if ($errors->has('body'))
                                <small class="text-danger">{{ $errors->first('body') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                          <select class="form-control" name="category">
                              @foreach ($categories as $category)
                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                        <input type="submit" value="Dodaj ogłoszenie" class="btn btn-primary btn-block">
                    </div>
                </div>
            </form>

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
