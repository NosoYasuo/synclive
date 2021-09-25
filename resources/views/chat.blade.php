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
    <div class="chat-area">
        <div class="card">
            <div class="card-header">Comment</div>
            <div class="card-body chat-card">
                @foreach ($comments as $item)
                @include('components.comment', ['item' => $item])
                @endforeach
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ url('add')}}">
    @csrf
    <div class="comment-container row justify-content-center">
        <div class="input-group comment-area">
            <textarea class="form-control" id="comment" name="comment" placeholder="push massage (shift + Enter)"
                aria-label="With textarea"
                onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
            <button type="submit" id="submit" class="btn btn-outline-primary comment-btn">Submit</button>
        </div>
    </div>
</form>

@endsection
