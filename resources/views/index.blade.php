<!-- resources/views/books.blade.php -->

@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css?20211010')}}">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{ asset('/js/index.js') }}"></script>

<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
<!-- バリデーションエラーの表示に使用-->

@auth
<!-- watch ID登録フォーム -->
<div class="wrap">
 <div class="sticky-top">
  <div class="flex container">
    <div class="d-flex bd-highlight mb-2">
<form action="{{ url('postWatch') }}" method="POST" class="form-inline">
    {{ csrf_field() }}
    <div class="form-group mb-2">
      <div class="col-sm-6">
        Watch ID<input type="text" name="watch" class="form-control">
      </div>
    </div>

    <!-- 本 登録ボタン -->
    <div class="form-group">
     <div class="col-sm-offset-3 col-sm-6">
      <button type="submit" class="btn btn-secondary">sync</button>
     </div>
    </div>
  </form>
  <form action="{{ url('getSearch') }}" method="GET" class="form-inline">
    {{ csrf_field() }}
    <div class="form-group mb-2">
      <div class="col-sm-6">
        Search<input type="text" name="search" class="form-control">
      </div>
    </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-secondary">search</button>
        </div>
      </div>
    </div>
  </form>

@endif
<div class="p-3 mb-2 .bg-gradient-dark bg-secondary text-white">
<h1 class="text-center"> 𝙎𝙮𝙣𝙘𝙇𝙞𝙫𝙚 </h1>
<h5 class="text-center">You are also a Live-creator in the world!</h5>
</div>
</div>
</div>





<!-- 現在の本 -->
@if (count($watches) > 0)
{{-- <div>Watch一覧</div> --}}
<div class="card-body d-flex justify-content-around align-content-between flex-wrap">
  <!-- テーブル本体 -->
  @foreach ($watches as $watch)
  <!-- 本タイトル -->
  <div class="p-2">

    <!--autoplay=1&mute=1&playsinline=1&loop=1-->

    <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$watch->watch}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$watch->watch}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <div style="display:none">W# {{$watch->id}}</div>
    <div>{{ __('lively') }}:{{$watch->author}}</div>
    <div class="box-read">title:{{$watch->title}}</div>
    <div style="display:none" >watch:{{$watch->watch}}</div>
    @if($watch->user_id == Auth::id())
      <div>user_name:{{$watch->user->name}}</div>
    @else
      <div><a href="{{ url('userpage/'.$watch->user_id)}}">user_name:{{$watch->user->name}}</a></div>
    @endif
    <div>created_at:{{$watch->created_at}}</div>
  </div>
  @endforeach
</div>
@endif

<!-- 既に登録されてるリスト -->
@if (count($channels) > 0)
  {{-- <div>Channel一覧</div> --}}
  <div class="card-body d-flex justify-content-around align-content-between flex-wrap">
  @foreach ($channels as $channel)
    <div class="p-2">
      <!-- 本タイトル -->
      <!-- ?autoplay=1&mute=1&playsinline=1&loop=1 -->
      <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$channel->GetId($channel->channel)}}?autoplay=1&mute=1&playsinline=1&loop=1" frameborder="0" allowfullscreen></iframe>

      <div style="display:none;">watch:<a id="c_watchId{{$channel->id}}">{{$channel->GetId($channel->channel)}}</a></div>
      <div style="display: none">C# {{$channel->id}}</div>
      <div>lively:<a id="c_author{{$channel->id}}"></a></div>
      <div class="box-read">title:<a id="c_title{{$channel->id}}"></a></div>
      @if($channel->user_id == Auth::id())
      <div>user_name:{{$channel->user->name}}</div>
      @else
      <div><a href="{{ url('userpage/'.$channel->user_id)}}">user_name:{{$channel->user->name}}</a></div>
      @endif
      <div>created_at:{{$channel->created_at}}</div>
    </div>
      <script>GetInfoChannel({{$channel->id}});</script>
  @endforeach
  </div>
@endif

@auth
  <!-- チャンネルID登録フォーム -->
<div class="fixed-bottom:auto">
  <div class="flex-container">
    <form action="{{ url('postChannel') }}" method="POST" class="form-inline">
      {{ csrf_field() }}

        <div class="form-group mb-2">
          <div class="col-sm-6">
            Channel ID<input type="text" size="27" name="channel" class="form-control">
          </div>
        </div>
      <!-- 本 登録ボタン -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-secondary">sync</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endif
@endsection
