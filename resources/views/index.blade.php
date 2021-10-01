<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{ asset('/js/index.js') }}"></script>

<h1 class="text-center">𝙎𝙮𝙣𝙘😄𝙇𝙞𝙫𝙚</h1>
<h3 class="text-center">あなたも世界をライブ・プロデュース！💌</h3>

<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
<!-- バリデーションエラーの表示に使用-->

<!-- 現在の本 -->
@if (count($channels) > 0)
<div>Channel一覧</div>
<div class="card-body d-flex">
@foreach ($channels as $channel)
  <div>
    <div>{{$channel->id}}</div>
    <!-- ?autoplay=1&mute=1&playsinline=1&loop=1 -->
    <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$channel->GetId($channel->channel)}}?mute=1&playsinline=1&loop=1" frameborder="0" allowfullscreen></iframe>
    <div>作者:<a id="c_author{{$channel->id}}"></a></div>
    <div>タイトル:<a id="c_title{{$channel->id}}"></a></div>
    <div>watch:<a id="c_watchId{{$channel->id}}">{{$channel->GetId($channel->channel)}}</a></div>
    <div>name:<a href="{{ url('userpage/'.$channel->user_id)}}">{{$channel->user->name}}</a></div>
    <div>created_at:{{$channel->created_at}}</div>
  </div>
    <script>GetInfoChannel({{$channel->id}});</script>
@endforeach
</div>
@endif

<!-- 現在の本 -->
@if (count($watches) > 0)
<div>Watch一覧</div>
<div class="card-body d-flex">
  <!-- テーブル本体 -->
  @foreach ($watches as $watch)
  <!-- 本タイトル -->
  <div>
    <div>ID{{$watch->id}}</div>
    <!--autoplay=1&mute=1&playsinline=1&loop=1-->
    <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$watch->watch}}?mute=1&playsinline=1&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <div>作者:<a id="author{{$watch->id}}"></a></div>
    <div>タイトル:<a id="title{{$watch->id}}"></a></div>
    <div>watch:<a id="watchId{{$watch->id}}">{{$watch->watch}}</a></div>
    <div>name:<a href="{{ url('userpage/'.$watch->user_id)}}">{{$watch->user->name}}</a></div>
    <div>created_at:{{$watch->created_at}}</div>
  </div>
  <script>GetInfoWatch({{$watch->id}});</script>
  @endforeach
</div>
@endif
<!-- 既に登録されてるリスト -->

  @auth
    <!-- チャンネルID登録フォーム -->
    <form action="{{ url('postChannel') }}" method="POST" class="form-horizontal">
      {{ csrf_field() }}
      <div>
        <div>
          チャンネルID<input type="text" name="channel_id" class="">
        </div>
      </div>
      <!-- 本 登録ボタン -->
      <div class="">
        <div class="">
          <button type="submit" class="">Save</button>
        </div>
      </div>
    </form>

    <!-- watch ID登録フォーム -->
    <form action="{{ url('postWatch') }}" method="POST" class="">
      {{ csrf_field() }}
      <div class="">
        <div class="">
          watchID<input type="text" name="watch_id" class="">
        </div>
      </div>

      <!-- 本 登録ボタン -->
      <div class="">
        <button type="submit" class="">Save</button>
      </div>
    </form>
  @endif
@endsection
