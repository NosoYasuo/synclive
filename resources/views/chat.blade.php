@extends('layouts.app')

@section('content')
<style>
  .chat-container {
  width: 100%;
  height: 100%;
}

.chat-card {
  height: 67vh;
  overflow: auto;
}

.chat-area {
  width: 70%;
}

.comment-container {
  position: fixed;
  bottom: 20px;
  text-align: center;
  width: 100%;
}

.comment-area {
  width: 70%;
}

.comment-btn {
  margin: 0px 10px;
}

.comment-body {
  padding: 5px 30px 20px 30px;
}

.comment-body:hover {
  background-color: #dfdfdf;
}

.comment-body-user {
  font-weight: bold;
  font-size: 20px;
}

.comment-body-time {
  font-size: 10px;
  margin-top: 10px;
  margin-left: 5px;
  color: #a0a0a0;
}
</style>
<div class="chat-container row justify-content-center">
    <div class="chat-area col-10">
        <div class="card">
            <div class="card-header">Comment</div>
            <div class="card-body chat-card">
                <div id="comment-data"></div>
            </div>
        </div>
    </div>
</div>

<form action="{{ url('add') }}" method="POST" class="form-horizontal">
  {{ csrf_field() }}
    <div class="comment-container row justify-content-center">
        <div class="input-group comment-area col-10">
            <textarea class="form-control" id="chat_comment" name="comment" placeholder="push massage (shift + Enter)"
                aria-label="With textarea"
                onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
                {{-- chat先ID --}}
                <input type="hidden" id ="user1" value="{{$room->user1}}">
                <input type="hidden" id ="user2" value="{{$room->user2}}">
                @if($room->user1 == Auth::id())
                <input type="hidden" name ="recipient_id" value="{{$room->user2}}">
                @else()
                <input type="hidden" name ="recipient_id" value="{{$room->user1}}">
                @endif
                <input type="hidden" name ="room_id" value="{{$room->id}}">
            <button type="submit" class="btn btn-outline-primary comment-btn">Submit</button>
        </div>
    </div>
</form>

@section('js')
<script src="{{ asset('js/comment.js') }}"></script>

<script>
    let id1 = document.getElementById("user1").value;
    let id2 = document.getElementById("user2").value;
    console.log(id1);
    console.log(id2);
</script>
@endsection

@endsection
