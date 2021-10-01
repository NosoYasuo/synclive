<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{ asset('/js/index.js') }}"></script>

<div>MYPAGE</div>

<div>ID:{{Auth::id()}}</div>
<div>name:{{Auth::user()->name}}</div>



<div>最新メッセージ</div>
<div class="card-body d-flex">
  <!-- テーブル本体 -->
  <table class="table table-striped table-hover">
    <thead>
      <td>名前</td>
      <td>内容</td>
      <td>最終メッセージ時間</td>
    </thead>
    <tbody>
        <tr>
          <th scope="row">{{$comment->name}}</th>
          <td class="table-active"><a href="{{ url('chat/'.$comment->login_id)}}">{{$comment->comment}}</a></td>
          <td>{{$comment->updated_at}}</td>
        </tr>
    </tbody>
  </table>
</div>

@if (count($channels) > 0)
  <div>自分のChannel一覧</div>
  <div class="card-body d-flex">
    <!-- テーブル本体 -->
    @foreach ($channels as $channel)
  <div>
    <!-- 本タイトル -->
    <div>{{$channel->id}}</div>
    <!-- ?autoplay=1&mute=1&playsinline=1&loop=1 -->
    <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$channel->GetId($channel->channel)}}?mute=1&playsinline=1&loop=1" frameborder="0" allowfullscreen></iframe>
    <div>作者:<a id="c_author{{$channel->id}}"></a></div>
    <div>タイトル:<a id="c_title{{$channel->id}}"></a></div>
    <div>watch:<a id="c_watchId{{$channel->id}}">{{$channel->GetId($channel->channel)}}</a></div>
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
    <script>GetInfoChannel({{$channel->id}});</script>
    @endforeach
  </div>
@endif


@if (count($watches) > 0)
  <div>自分のWatch一覧</div>
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
    <div>created_at:{{$watch->created_at}}</div>
    <script>GetInfoWatch({{$watch->id}});</script>

      <!-- 本: 削除ボタン -->
      <form action="{{ url('watch/'.$watch->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <button type="submit" class="">
          DELETE
        </button>
      </form>
    </div>
    <script>GetInfoWatch({{$watch->id}});</script>
    @endforeach
  </div>
@endif

@endsection
