<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<style>h1{
    text-align:center;          /* IE用の中央寄せ */
    border:dotted 1px #cecbcb;  /* 枠線（色） */
    display: block;
    background-color: rgb(247, 245, 245);
    margin:0 auto;
    max-width: auto;
  }

  h3{
    color:darkkhaki
  }


  .all {
    text-align:center;          /* IE用の中央寄せ */
    border:dotted 1px #cecbcb;  /* 枠線（赤） */
    /* width: 1560px; */
    display: block;
    margin:0 auto;
    max-width: auto;
  }

  ul{
    display: flex;
    justify-content: center;
    /* width: 1560px; */
    /* padding-left: 100px;
    padding-right: 100px; */
    max-width: auto;
  }

  .wrapper{
    text-align: center;
    display: block;
    margin:0 auto;

  }



  .imgs{
    width:25%;
    transition: all 1s linear 0s;
  }
  .imgs:hover {
    transform: rotateZ(360deg);
   }
   audio { width: 9%; }

   .tsuzuku{
     padding-top: 100px;
     color:red;
   }



</style>
<!-- Bootstrapの定形コード… -->
<div>
  <div>

  </div>

  <!-- バリデーションエラーの表示に使用-->
  @include('common.errors')
  <!-- バリデーションエラーの表示に使用-->

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


  <!-- 現在の本 -->
  @if (count($channels) > 0)
  <div class="">
    <div class="">
      <table class="">
        <!-- テーブルヘッダ -->
        <thead>
          <th>Channel一覧</th>
          <th>&nbsp;</th>
        </thead>
        <!-- テーブル本体 -->
        <tbody>
          @foreach ($channels as $channel)
          <tr>
            <!-- 本タイトル -->
            <td class="table-text">
              <iframe width="480" height="360" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($channel->GetId($channel->channel), ENT_QUOTES, 'UTF-8') ?>" frameborder="0" allowfullscreen></iframe>

            </td>

            <!-- 本: 削除ボタン -->
            <td>
              <form action="{{ url('channel/'.$channel->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="">
                  削除
                </button>
              </form>
            </td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif
</div>
<!-- Book: 既に登録されてる本のリスト -->
<!-- 現在の本 -->
@if (count($watches) > 0)
<div class="card-body">
  <div class="card-body">
    <table class="table table-striped task-table">
      <!-- テーブルヘッダ -->
      <thead>
        <th>Watch一覧</th>
        <th>&nbsp;</th>
      </thead>
      <!-- テーブル本体 -->
      <tbody>
        @foreach ($watches as $watch)
        <tr>
          <!-- 本タイトル -->
          <td class="table-text">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$watch -> watch}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </td>

          <!-- 本: 削除ボタン -->
          <td>
            <form action="{{ url('watch/'.$watch->id) }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('delete') }}
              <button type="submit" class="btn btn-danger">
                削除
              </button>
            </form>
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif
</div>
<!-- Book: 既に登録されてる本のリスト -->


@endsection
