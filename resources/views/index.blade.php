<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<style>
  h1 {
    text-align: center;
    /* IE用の中央寄せ */
    border: dotted 1px #cecbcb;
    /* 枠線（色） */
    display: block;
    background-color: rgb(247, 245, 245);
    margin: 0 auto;
    max-width: auto;
  }

  h3 {
    color: darkkhaki
  }


  .all {
    text-align: center;
    /* IE用の中央寄せ */
    border: dotted 1px #cecbcb;
    /* 枠線（赤） */
    /* width: 1560px; */
    display: block;
    margin: 0 auto;
    max-width: auto;
  }

  ul {
    display: flex;
    justify-content: center;
    /* width: 1560px; */
    /* padding-left: 100px;
    padding-right: 100px; */
    max-width: auto;
  }

  .wrapper {
    text-align: center;
    display: block;
    margin: 0 auto;

  }



  .imgs {
    width: 25%;
    transition: all 1s linear 0s;
  }

  .imgs:hover {
    transform: rotateZ(360deg);
  }

  audio {
    width: 9%;
  }

  .tsuzuku {
    padding-top: 100px;
    color: red;
  }
</style>
<!-- Bootstrapの定形コード… -->
<div>

  <h1 div class="text-center">𝙎𝙮𝙣𝙘😄𝙇𝙞𝙫𝙚</div>
    <div>

        <h3 div class="text-center">あなたも世界をライブ・プロデュース！💌</div>

  <!-- バリデーションエラーの表示に使用-->
  @include('common.errors')
  <!-- バリデーションエラーの表示に使用-->




  <!-- 現在の本 -->
  @if (count($channels) > 0)
  <div>Channel一覧</div>
  <div class="card-body d-flex">

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
  <div class="card-body d-flex">

    <!-- テーブル本体 -->
    @foreach ($watches as $watch)
    <!-- 本タイトル -->
    <div>
      <div>{{$watch->id}}</div>
      <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$watch -> watch}}?autoplay=1&mute=1&playsinline=1&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
