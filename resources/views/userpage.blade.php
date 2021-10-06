<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{ asset('/js/index.js') }}"></script>

<div class="container">
<div class="display-3">Userpage</div>

<div class="lead">user_id{{$user->id}}</div>
<div class="lead">to {{$user->name}}</div>
<div>メッセージ</div>
<div>プロフィール{{$user->profile}}</div>
<div>ライブ可能時間{{$user->avail_time}}</div>
<div>金額{{$user->price}}円</div>

<button><a href="{{ url('room/'.$user->id)}}">CHATする</a></button>
</div>



{{-- watch表示 --}}
@if (count($watches) > 0)
  <div class="lead">{{$user->name}}のWatch一覧</div>
  <div class="card-body d-flex">
    <!-- テーブル本体 -->
    @foreach ($watches as $watch)
  <!-- 本タイトル -->
    <div class="container">
      <div>W#{{$watch->id}}</div>
      <!--autoplay=1&mute=1&playsinline=1&loop=1-->
      <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$watch->watch}}?mute=1&playsinline=1&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <div>作者:<a id="author{{$watch->id}}"></a></div>
      <div>タイトル:<a id="title{{$watch->id}}"></a></div>
      <div>watch:<a id="watchId{{$watch->id}}">{{$watch->watch}}</a></div>
      <div>created_at:{{$watch->created_at}}</div>
      <script>GetInfoWatch({{$watch->id}});</script>
    </div>
    <script>GetInfoWatch({{$watch->id}});</script>
    @endforeach
  </div>
@endif


{{-- channels表示 --}}
@if (count($channels) > 0)
<div class="lead">{{$user->name}}のChannel一覧</div>
  <div class="card-body d-flex">
    <!-- テーブル本体 -->
    @foreach ($channels as $channel)
  <div class="container">
    <!-- 本タイトル -->
    <div>C#{{$channel->id}}</div>
    <!-- ?autoplay=1&mute=1&playsinline=1&loop=1 -->
    <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$channel->GetId($channel->channel)}}?mute=1&playsinline=1&loop=1" frameborder="0" allowfullscreen></iframe>
    <div>作者:<a id="c_author{{$channel->id}}"></a></div>
    <div>タイトル:<a id="c_title{{$channel->id}}"></a></div>
    <div>channel:<a id="c_watchId{{$channel->id}}">{{$channel->GetId($channel->channel)}}</a></div>
    <div>created_at:{{$channel->created_at}}</div>
    <script>GetInfoChannel({{$channel->id}});</script>
    @endforeach
  </div>
</div>
@endif

@endsection
