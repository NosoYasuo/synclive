<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<div>MYPAGE</div>

<div>ID:{{Auth::id()}}</div>
<div>name:{{Auth::user()->name}}</div>


<div>chat一覧</div>
<table class="table table-striped table-hover">
  <thead>
    <td>
      名前
    </td>
      <td>
      内容
    </td>
     <td>
      最終メッセージ時間
    </td>
  </thead>
  <tbody>
    <tr>
      <th scope="row">田中太郎</th>
      <td class="table-active">こんにちは！</td>
      <td>12:30</td>
    </tr>
    <tr>
      <th scope="row">田中太郎</th>
      <td class="table-active">こんにちは！</td>
      <td>12:30</td>
    </tr>
    <tr>
      <th scope="row">田中太郎</th>
      <td class="table-active">こんにちは！</td>
      <td>12:30</td>
    </tr>
  </tbody>
</table>

@endsection
