<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')


<!-- Bootstrapの定形コード… -->
<div>

  <h1 div class="text-center">𝙎𝙮𝙣𝙘😄𝙇𝙞𝙫𝙚</div>
    <div>

        <h5 div class="text-center">あなたも世界をライブ・プロデュース！💌</div>

  <!-- バリデーションエラーの表示に使用-->
  @include('common.errors')
  <!-- バリデーションエラーの表示に使用-->




  <!-- 現在の本 -->
  @if (count($channels) > 0)
  <div>Channel一覧</div>
  <div class="card-body d-flex justify-content-around flex-wrap">

    @foreach ($channels as $channel)
    <div class="">
      <!-- 本タイトル -->
      <div>{{$channel->id}}</div>
      <iframe width="373" height="210" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($channel->GetId($channel->channel), ENT_QUOTES, 'UTF-8') ?>?autoplay=1&mute=1&playsinline=1&loop=1" frameborder="0" allowfullscreen></iframe>
      <div>channel:{{$channel->channel}}</div>
      <div>users_id:{{$channel->users_id}}</div>
      <div>created_at:{{$channel->created_at}}</div>

      <!-- 本: 削除ボタン -->
      <form action="{{ url('channel/'.$channel->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <button type="submit" class="">
          DELETE
        </button>
      </form>
    </div>
    @endforeach
  </div>
  @endif
  <!-- Book: 既に登録されてる本のリスト -->
  <!-- 現在の本 -->
  @if (count($watches) > 0)
  <div>Watch一覧</div>
  <div class="card-body d-flex justify-content-around flex-wrap">

    <!-- テーブル本体 -->
    @foreach ($watches as $watch)
    <!-- 本タイトル -->
    <div>
      <div>{{$watch->id}}</div>
      <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$watch -> watch}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$watch -> watch}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <div>channel:{{$watch->watch}}</div>
      <div>users_id:{{$watch->users_id}}</div>
      <div>created_at:{{$watch->created_at}}</div>

      <!-- 本: 削除ボタン -->
      <form action="{{ url('watch/'.$watch->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <button type="submit" class="">
          DELETE
        </button>
      </form>
    </div>
    @endforeach
  </div>
  @endif
  <!-- Book: 既に登録されてる本のリスト -->


  <!-- 本登録フォーム -->
  <form action="{{ url('post') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <div>
      <div>
        チャンネルID<input type="text" name="channel_id" class="">
      </div>
    </div>

    <!-- 本 登録ボタン -->
    <div class="">
      <div class="">
        <button type="submit" class="">
          Save
        </button>
      </div>
    </div>
  </form>

  <form action="{{ url('watch') }}" method="POST" class="">
    {{ csrf_field() }}

    <div class="">
      <div class="">
        watchID<input type="text" name="watch_id" class="">
      </div>
    </div>

    <!-- 本 登録ボタン -->
    <div class="">
      <div class="">
        <button type="submit" class="">
          Save
        </button>
      </div>
    </div>
  </form>
  </div>
  @endsection
