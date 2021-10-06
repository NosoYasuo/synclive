<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{ asset('/js/index.js') }}"></script>

<div class="container">
<div class="col-sm-6 display-3">MYPAGE</div>

<div class="lead">ID:{{Auth::id()}}</div>
<div class="lead">name:{{Auth::user()->name}}</div>

@if($rooms)
  <div>※最新メッセージ※</div>
  <div class="card-body d-flex">
    <!-- テーブル本体 -->

    <table class="table table-striped table-hover">
      <thead>
        <td>名前</td>
        <td>内容</td>
        <td>最終メッセージ時間</td>
      </thead>
      <tbody>
      @foreach ($rooms as $room)
        @if($room->comments->last())
            <tr>
              @if($room->user1 !== Auth::id())
              <th scope="row">{{$room->get_user1->name}}</th>
              <th scope="row"><a href="{{url('room/'.$room->user1)}}">{{$room->comments->last()->comment}}</a></th>
              <th scope="row">{{$room->comments->last()->created_at}}</th>
              @else
              <th scope="row">{{$room->get_user2->name}}</th>
              <th scope="row"><a href="{{url('room/'.$room->user2)}}">{{$room->comments->last()->comment}}</a></th>
              <th scope="row">{{$room->comments->last()->created_at}}</th>
              @endif
            </tr>
        @else
        <tr><th colspan="3">メッセージはまだありません</th></tr>
        @endif
      @endforeach
      </tbody>
    </table>
  </div>
@else
<div>メッセージはまだありません</div>
@endif

@if (count($watches) > 0)
  <div class="lead">自分のWatch一覧</div>
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

      <!-- 本: 削除ボタン -->
      <form action="{{ url('watch/'.$watch->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <button type="submit" class="">
          delete(！削除：ここをクリックすると削除します)
        </button>
      </form>
    </div>
    <script>GetInfoWatch({{$watch->id}});</script>
    @endforeach
  </div>
@endif



@if (count($channels) > 0)
<div class="lead">自分のChannel一覧</div>
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

    <!-- 本: 削除ボタン -->
    <form action="{{ url('channel/'.$channel->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('delete') }}
      <button type="submit" class="">
        delete(！削除：ここをクリックすると削除します)
      </button>
    </form>

    <script>GetInfoChannel({{$channel->id}});</script>
    @endforeach
  </div>
</div>
@endif




@endsection
