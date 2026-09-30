<!DOCTYPE html>
<html>
<head>
   <title>Testing- @yield('title','website')</title>
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   
</head>   
<body>
<div id="wrapper">
  <header>
   <h1> Websoftonic </h1>
  </header>  
  <nav>
   <a href="{{ route('home') }}">Home</a>
   <a href="{{ route('about') }}">About</a>
   <a href="{{ route('mypost') }}">Post</a>
  </nav>
  
@foreach($fruits as $val)
  @if($val)
    <p> {{ $val }}</p>
  @endif
@endforeach 