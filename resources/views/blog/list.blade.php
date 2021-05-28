@extends('layouts.app')
@section('content')
@if(session('create_msg'))
  <p class="alert alert-success" role="alert">{{ session('create_msg') }}</p>
@endif
@if(session('err_msg'))
  <p class="alert alert-danger" role="alert">{{ session('err_msg') }}</p>
@endif
<div>
  <button class="btn btn-primary" onclick="location.href='{{ route('create') }}'">ブログ作成</button>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">作成者</th>
      <th scope="col">タイトル</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($blogs as $blog)
    <tr>
      <td>
        <div class="table-text"></div>
      </td>
      <!-- 本タイトル -->
      <td class="table-text">
        <div>{{ $blog->title }}</div>
      </td>

      <!-- 本: 詳細ボタン -->
      <td>
        <button type="button" class="btn btn-success" onclick="location.href='/blog/detail/{{ $blog->id }}'">詳細</button>
      </td>
      <!-- 本: 編集ボタン -->
      <td>
        <button type="button" class="btn btn-primary" onclick="location.href='/blog/edit/{{ $blog->id }}'">編集</button>
      </td>
      <!-- 本: 削除ボタン -->
      <td>
        <form method="POST" action="{{ route('delete', $blog->id) }}" onSubmit="return checkDelete()">  
          @csrf
          <button type="submit" class="btn btn-danger">削除</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<script>
  function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
      return true;
    } else {
      return false;
    }
  }
</script>

@endsection