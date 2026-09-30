@php 
 $fruits= ['Apple','Banana','Orange','Grapes'];
 $value="";
 // runs only first parameter true
@endphp 
@includeWhen(empty($value),'pages.header',['fruits'=>$fruits]) 
<h1> Our first Page </h1>
<a href="{{ route('mypost',1) }}">Post page</a> &nbsp;
<a href="{{ route('about') }}">About page</a>

<br/> <br/><br/>
{{ 5+2 }}
<br/> <br/>
{{ "Hello World" }}

{!! "<h1> Yahoo Baba </h1>" !!}

{{-- {!! "<script>alert('hello')</script>" !!} --}}

@php 
$user = ['a','b','c','d','e'];
@endphp 
<ul>
@foreach ($user as $val)
@if($loop->first)
<li style="color:red">{{ $loop->index}}-{{$loop->iteration}}-{{ $val }}</li>
@else
  <li>{{ $loop->index}}-{{$loop->iteration}}-{{ $val }}</li> 
@endif  
@endforeach
</ul>

@includeUnless(false,'pages.footer',['name'=>'Websoftonic'])

@includeIf('pages.invalidfooter')