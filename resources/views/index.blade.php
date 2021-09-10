<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')


<!-- Bootstrapの定形コード… -->
<div class="card-body">
  <div class="card-title">

  </div>

  <!-- バリデーションエラーの表示に使用-->
  @include('common.errors')
  <!-- バリデーションエラーの表示に使用-->

  <!-- 本登録フォーム -->
  <form action="{{ url('post') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <div class="form-group">
      <div class="col-sm-6">
        チャンネルID<input type="text" name="channel_id" class="form-control">
      </div>
    </div>

    <!-- 本 登録ボタン -->
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-primary">
          Save
        </button>
      </div>
    </div>
  </form>

  <form action="{{ url('post') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <div class="form-group">
      <div class="col-sm-6">
        watchID<input type="text" name="watch_id" class="form-control">
      </div>
    </div>

    <!-- 本 登録ボタン -->
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-primary">
          Save
        </button>
      </div>
    </div>
  </form>


  <!-- 現在の本 -->
  @if (count($channels) > 0)
  <div class="card-body">
    <div class="card-body">
      <table class="table table-striped task-table">
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
              <form action="{{ url('post/'.$channel->id) }}" method="POST">
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
