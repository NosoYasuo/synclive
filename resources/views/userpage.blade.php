<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<div class="container">
<div class="display-3">Userpage</div>

<div class="lead">user_id{{$user->id}}</div>
<div class="lead">to {{$user->name}}</div>

<button><a href="{{ url('room/'.$user->id)}}">CHATする</a></button>
</div>

@endsection
