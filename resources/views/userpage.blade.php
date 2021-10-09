<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{ asset('/js/index.js') }}"></script>

<div class="frex container">
<div class="display-3" style="background-color: rgb(235, 235, 235)">Userpage</div>

<div class="lead" style="display:none;">user_id{{$user->id}}</div>

<div class="lead">from {{$user->name}}</div>
<div>プロフィール：{{$user->profile}}</div>
<div>ライブ可能時間：{{$user->avail_time}}</div>
<div>金額：{{$user->price}}円</div>
<div>・・・・・・・・・・・・・</div>
<div>共感や声援、生ライブして欲しい気持ち等のメッセージを送ろう</div>
<div class="lead">to {{$user->name}}</div>
<button><a href="{{ url('room/'.$user->id)}}">CHATする</a></button>

{{-- watch表示 --}}
@if (count($watches) > 0)
<div style="padding-top:30px;">
  <div class="lead">{{$user->name}}のWatch一覧</div>
  <div class="card-body d-flex justify-content-around flex-wrap">
    <!-- テーブル本体 -->
    @foreach ($watches as $watch)
    <div>
  <!-- 本タイトル -->
    {{-- <div class="container"> --}}

      <!--autoplay=1&mute=1&playsinline=1&loop=1-->
      <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$watch->watch}}?mute=1&playsinline=1&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <div>W#{{$watch->id}}</div>
      <div>作者:<a id="author{{$watch->id}}"></a></div>
      <div>タイトル:<a id="title{{$watch->id}}"></a></div>
      <div style="display:none">watch<a id="watchId{{$watch->id}}">{{$watch->watch}}</a></div>
      <div>created_at:{{$watch->created_at}}</div>
      {{-- <script>GetInfoWatch({{$watch->id}});</script> --}}

    <script>GetInfoWatch({{$watch->id}});</script>
   </div>
    @endforeach
  </div>
@endif


{{-- channels表示 --}}
@if (count($channels) > 0)
<div class="lead">{{$user->name}}のChannel一覧</div>
  <div class="card-body d-flex justify-content-around flex-wrap">
    <!-- テーブル本体 -->
    @foreach ($channels as $channel)
  <div>
  {{-- <div class="container"> --}}
    <!-- 本タイトル -->

    <!-- ?autoplay=1&mute=1&playsinline=1&loop=1 -->
    <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$channel->GetId($channel->channel)}}?mute=1&playsinline=1&loop=1" frameborder="0" allowfullscreen></iframe>
    <div>C#{{$channel->id}}</div>
    <div>作者:<a id="c_author{{$channel->id}}"></a></div>
    <div>タイトル:<a id="c_title{{$channel->id}}"></a></div>
    <div style="display:none">channel:<a id="c_watchId{{$channel->id}}">{{$channel->GetId($channel->channel)}}</a></div>
    <div>created_at:{{$channel->created_at}}</div>
    <script>GetInfoChannel({{$channel->id}});</script>
    @endforeach
  </div>

@endif
@endsection
