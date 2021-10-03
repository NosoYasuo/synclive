<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

<div>Userpage</div>

<div>{{$user->id}}</div>
<div>{{$user->name}}</div>

<button><a href="{{ url('room/'.$user->id)}}">CHATする</a></button>


@endsection
