@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css?20211010')}}">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="{{ asset('/js/index.js') }}"></script>

@if($watches->count())

<div class="card-body d-flex justify-content-around align-content-between flex-wrap">

{{-- <table border="1"> --}}
    {{-- <tr>
        <th>title</th>
        <th>author</th>
        <th>name</th>
    </tr> --}}
    @foreach ($watches as $watch)
    <!-- 本タイトル -->
    <div class="p-2">

      <!--autoplay=1&mute=1&playsinline=1&loop=1-->

      <iframe width="373" height="210" src="https://www.youtube.com/embed/{{$watch->watch}}?autoplay=1&mute=1&playsinline=1&loop=1&playlist={{$watch->watch}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <div style="display:none">W# {{$watch->id}}</div>
      <div>{{ __('lively') }}:{{$watch->author}}</div>
      <div class="box-read">title:{{$watch->title}}</div>
      <div style="display:none" >watch:{{$watch->watch}}</div>
      @if($watch->user_id == Auth::id())
        <div>user_name:{{$watch->user->name}}</div>
      @else
        <div><a href="{{ url('userpage/'.$watch->user_id)}}">user_name:{{$watch->user->name}}</a></div>
      @endif
      <div>created_at:{{$watch->created_at}}</div>
    </div>
    @endforeach
</table>

</div>

@else
<p>見つかりませんでした。</p>
@endif
@endsection


