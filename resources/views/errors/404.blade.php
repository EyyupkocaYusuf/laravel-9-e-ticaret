@extends('layouts.master')
@section('content')
<div class="container">
    <div class="jumbotron text-center">
        <h1>404</h1>
        <h2>Aradıgınız Sayfa Bulunamadı !</h2>
        <a href="{{route('home')}}" class="btn btn-primary">Ana Sayfaya Dön</a>
        <h5>{{$exception}}</h5>
    </div>
</div>
@endsection
