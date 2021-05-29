@extends('layouts.app')
@section('content')
<form class="create_form" action="{{ route('store') }}" method="POST">
  @csrf
  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
  <div class="form-group title">
    <label for="title"><strong>タイトル</strong></label>
    <input type="text" name="title" class="form-control" id="title"　value="{{ old('title') }}">
    @if ($errors->has('title'))
      <div class="text-danger">
          {{ $errors->first('title') }}
      </div>
    @endif
  </div>
  
  <div class="form-group content">
    <label for="content"><strong>本文</strong></label>
    <textarea class="form-control" name="content" id="content" rows="10" value="{{ old('content') }}"></textarea>
    @if ($errors->has('content'))
      <div class="text-danger">
          {{ $errors->first('content') }}
      </div>
    @endif
  </div>

  <div class="create_btn">
    <button type="submit" class="btn btn-primary">投稿</button>
  </div>
</form>
@endsection