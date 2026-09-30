<!DOCTYPE html>
<html>
<head>
   <title></title>
</head>
<body>
   {{ Auth::user() }}
   @if(auth()->check())
   <h3>Welcome {{ Auth::user()->name }}</h3>
   <img src="{{ asset('image/'.Auth::user()->image) }}" alt="profile-pic"/>
   @endif

   @if(session('status'))
     <div class="alert alert-success">{{ session('status') }}</div>
   @endif

  @can('isAdmin') 
     <a href="#" class="btn btn-success"> Admin Panel </a>
    @else
     <a href="#" class="btn btn-success"> Other Link </a>
  @endcan
  <br/>
<a href="{{ route('logout') }}">Logout</a>
</body> 
</html>

