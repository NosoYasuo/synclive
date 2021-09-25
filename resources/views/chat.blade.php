@extends('layouts.app')

@section('content')
<div class="chat-container row justify-content-center">
    <div class="chat-area">
        <div class="card">
            <div class="card-header">Comment</div>
            <div class="card-body chat-card">
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
                @include('components.comment')
            </div>
        </div>
    </div>
</div>

<div class="card-body chat-card">
    @foreach ($comments as $item)
    @include('components.comment', ['item' => $item])
    @endforeach
</div>

{{-- <div class="comment-container row justify-content-center">
    <div class="input-group comment-area">
        <textarea class="form-control" placeholder="input massage" aria-label="With textarea"></textarea>
        <button type="input-group-prepend button" class="btn btn-outline-primary comment-btn">Submit</button>
    </div>
</div> --}}

{{-- <form method="POST" action="{{route('add')}}">
    @csrf
    <div class="comment-container row justify-content-center">
        <div class="input-group comment-area">
            <textarea class="form-control" id="comment" name="comment" placeholder="input massage"
                aria-label="With textarea"></textarea>
            <button type="submit" class="btn btn-outline-primary comment-btn">Submit</button>
        </div>
    </div>
</form> --}}

<form method="POST" action="{{route('add')}}">
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
