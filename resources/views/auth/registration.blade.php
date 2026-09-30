<!DOCTYPE html>
<html>
<head>
   <title>Registration</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
</head>   
<body>
<form action="{{ route('registersave') }}" method="POST" enctype="multipart/form-data">
   @csrf
  <div class="container-fluid"> 
   <div class="row">
 <div class="form-group col-md-6">
    <label for="exampleInputname">Name</label>
    <input type="text" class="form-control" id="fname" name="fname"  placeholder="Enter your name">
  </div>  
  <div class="form-group col-md-6">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="fmail" name="fmail"  placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group col-md-6">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="pass" name="fpass"  placeholder="Password">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" id="pass" name="fpass_confirmation"  placeholder="Password">
  </div>
  <div class="form-group col-md-12">
    <label for="exampleInputPassword1">Image</label>
    <input type="file" class="form-control" id="myfile" name="photo"  placeholder="Password">
  </div>
  <div class="form-group col-md-6">
      <button type="submit" class="btn btn-primary"> Submit </button>
  </div>  
</form>
</div>
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
