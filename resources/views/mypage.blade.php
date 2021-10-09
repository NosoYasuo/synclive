<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{ asset('/js/index.js') }}"></script>

<div class="frex container">
<div class="display-3">MYPAGE</div>

<div class="lead" style="display:none">ID:{{Auth::id()}}</div>
<div class="lead">name:{{Auth::user()->name}}</div>
<div>
    <p><a href="{{ url('/password/change') }}">Change Password</a></p>
    </div>

<style>
    .tarea{
        display: inline-block;
        width: 100%;
        padding: 10px;
        border: 1px solid #999;
        box-sizing: border-box;
        background: #f2f2f2;
        margin: 0.5em 0;
        line-height: 1.5;
        height: 6em;
    }
    .txt{
        display: inline-block;
    width: 100%;
    padding: 0.5em;
    border: 1px solid #999;
    box-sizing: border-box;
    background: #f2f2f2;
    margin: 0.5em 0;
    }

    </style>

{{-- メッセージ更新 --}}
<form action="{{url('edit_prof')}}" method="POST">
  {{ csrf_field() }}
  <div> Profile（自己紹介）<textarea class="tarea" name="profile" style="width:300px">{{Auth::user()->profile}}</textarea></div>
  <div>Talk trip (Livestream) Possible date and time　（生ライブ可能な曜日、時間帯等）<input type="text"  placeholder="ex)Sat. Sun. Japan time pm" name="avail_time" style="width:250px;" value="{{Auth::user()->avail_time}}"></div>
  <div>Time required and amount（時間と金額）<input type="text" 　placeholder="ex) 25miniutes: ￥3000"　name="price" style="width:250px;" value="{{Auth::user()->price}}"></div>
  <button type="submit" class="">submit</button>
</form>

{{-- chat room表示 --}}
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
        @endif
      @endforeach
      </tbody>
    </table>
  </div>
@else
<div>メッセージはまだありません</div>
@endif

{{-- watch表示 --}}
@if (count($watches) > 0)
    <div class="lead">自分のWatch一覧</div>
    <div class="card-body d-flex justify-content-around flex-wrap">
    <!-- テーブル本体 -->
    @foreach ($watches as $watch)
        <div>
            <!-- 本タイトル -->
            {{-- <div class="container"> --}}
            <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$watch->watch}}?mute=1&playsinline=1&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div>W#{{$watch->id}}</div>
            <div>作者:<a id="author{{$watch->id}}"></a></div>
            <div>タイトル:<a id="title{{$watch->id}}"></a></div>
            <div style="display:none">watch:<a id="watchId{{$watch->id}}">{{$watch->watch}}</a></div>
            <div>created_at:{{$watch->created_at}}</div>
                    <!-- 本: 削除ボタン -->
                    <form action="{{ url('watch/'.$watch->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="">
                        delete(！削除：ここをクリックすると削除します)
                    </button>
                    </form>
            <script>GetInfoWatch({{$watch->id}});</script>
        </div>
    @endforeach
    </div>
@endif


{{-- channels表示 --}}
@if (count($channels) > 0)

<div class="lead">自分のChannel一覧</div>
<div class="card-body d-flex justify-content-around flex-wrap">
    <!-- テーブル本体 -->
    @foreach ($channels as $channel)
    <div>
        <!-- 本タイトル -->
        <!-- ?autoplay=1&mute=1&playsinline=1&loop=1 -->
        <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$channel->GetId($channel->channel)}}?mute=1&playsinline=1&loop=1" frameborder="0" allowfullscreen></iframe>
        <div>C#{{$channel->id}}</div>
        <div>lively:<a id="c_author{{$channel->id}}"></a></div>
        <div>title:<a id="c_title{{$channel->id}}"></a></div>
        <div style="display:none">channel:<a id="c_watchId{{$channel->id}}">{{$channel->GetId($channel->channel)}}</a></div>
        <div>created_at:{{$channel->created_at}}</div>

        <!-- 本: 削除ボタン -->
        <form action="{{ url('channel/'.$channel->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <button type="submit" class="">
            delete(！削除：ここをクリックすると削除します)
        </button>
        </form>
    </div>
    <script>GetInfoChannel({{$channel->id}});</script>
    @endforeach
</div>
@endif
@endsection
