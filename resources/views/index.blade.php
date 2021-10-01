<!-- resources/views/books.blade.php -->

@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="css/styles.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{ asset('/js/index.js') }}"></script>

@auth
<!-- watch ID登録フォーム -->
<div class="sticky-top">
<div class="flex container">
<form action="{{ url('watch') }}" method="POST" class="form-inline">
    {{ csrf_field() }}
    <div class="form-group mb-2">
      <div class="col-sm-6">
        Watch ID<input type="text" name="watch_id" class="form-control">
      </div>
    </div>

    <!-- 本 登録ボタン -->
    <div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
      <button type="submit" class="btn btn-secondary">sync</button>
    </div>
</div>
  </form>
@endif
<div class="p-3 mb-2 .bg-gradient-dark bg-secondary text-white">
<h2 class="text-center">𝙎𝙮𝙣𝙘𝙇𝙞𝙫𝙚</h2>
<h6 class="text-center">あなたも世界のライブクリエーター！</h6>
</div>
</div>
</div>



<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
<!-- バリデーションエラーの表示に使用-->

<!-- 現在の本 -->
@if (count($watches) > 0)
{{-- <div>Watch一覧</div> --}}
<div class="card-body d-flex justify-content-around flex-wrap">
  <!-- テーブル本体 -->
  @foreach ($watches as $watch)
  <!-- 本タイトル -->
  <div>

    <!--autoplay=1&mute=1&playsinline=1&loop=1-->

    <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$watch->watch}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$watch->watch}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <div>W# {{$watch->id}}</div>
    <div>channel:<a id="author{{$watch->id}}"></a></div>
    <div>title:<a id="title{{$watch->id}}"></a></div>
    <div style="display:none;">watch:<a id="watchId{{$watch->id}}">{{$watch->watch}}</a></div>
    <div>users_id:{{$watch->users_id}}</div>
    <div>created_at:{{$watch->created_at}}</div>
  </div>
  <script>GetInfoWatch({{$watch->id}});</script>
  @endforeach
</div>
@endif
<!-- 既に登録されてるリスト -->
@if (count($channels) > 0)
  {{-- <div>Channel一覧</div> --}}
  <div class="card-body d-flex justify-content-around flex-wrap">
  @foreach ($channels as $channel)
    <div>
      <!-- 本タイトル -->
      <!-- ?autoplay=1&mute=1&playsinline=1&loop=1 -->
      <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$channel->GetId($channel->channel)}}?autoplay=1&mute=1&playsinline=1&loop=1" frameborder="0" allowfullscreen></iframe>

      <div style="display:none;">watch:<a id="c_watchId{{$channel->id}}">{{$channel->GetId($channel->channel)}}</a></div>
      <div>C# {{$channel->id}}</div>
      <div>channel:<a id="c_author{{$channel->id}}"></a></div>
      <div>title:<a id="c_title{{$channel->id}}"></a></div>
      <div>users_id:{{$channel->users_id}}</div>
      <div>created_at:{{$channel->created_at}}</div>
    </div>
      <script>GetInfoChannel({{$channel->id}});</script>
  @endforeach
  </div>
@endif

@auth
  <!-- チャンネルID登録フォーム -->
  <div class="flex-container">
  <form action="{{ url('post') }}" method="POST" class="form-inline">
    {{ csrf_field() }}

      <div class="form-group mb-2">
          <div class="col-sm-6">
        Channel ID<input type="text" name="channel_id" class="form-control">
      </div>
  </div>

    <!-- 本 登録ボタン -->
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-secondary">sync</button>
      </div>
    </div>
  </div>
  </form>
@endif
@endsection
