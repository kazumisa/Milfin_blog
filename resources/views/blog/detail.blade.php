@extends('layouts.app')
@section('content')
<div>
  <div>
    <p>タイトル:{{ $blog->title }}</p>
    <p>作成日:{{ $blog->created_at }}</p>
    <p>更新日:{{ $blog->updated_at }}</p>
    <p>{{ $blog->content }}</p>
  </div>
</div>
@endsection