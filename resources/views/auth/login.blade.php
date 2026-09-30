<!DOCTYPE html>
<html>
<head>
   <title>Registration</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
</head>   
<body>
   <h2>Login</h2>
<form action="{{ route('logincheck') }}" method="POST">
   @csrf
  <div class="container-fluid"> 
   <div class="row">
  <div class="form-group col-md-6">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="fmail" name="email"  placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group col-md-6">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="pass" name="password"  placeholder="Password">
  </div>
 
  <div class="form-group col-md-6">
      <button type="submit" class="btn btn-primary"> Login </button>
  </div>  
</form>
</div>
@if(session('success'))
{{ session('success') }}
@endif
@if($errors->any())
<div class="card-footer text-body-secondary">
<div class="alert alert-danger">
 <ul>
   @foreach($errors->all() as $error)
   <li> {{ $error }} </li>
   @endforeach
 </ul>  
</div>
</div>
@endif
</div>



</body>
</html>
