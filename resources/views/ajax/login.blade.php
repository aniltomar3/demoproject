<!DOCTYPE html>
<html>
<head>
   <title>User Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>   
</head>   
<body>
 <div class="container-fluid"> 
   <div class="row">
       <h2>User Login</h2>
         <form action="">
         @csrf
   
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
               <button type="submit" class="btn btn-primary" id="loginbtn"> Login </button>
         </div>  
   </form>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
 $('#loginbtn').on('click',function(){
 const email= $('#fmail').val();
 const pass=  $('#pass').val();
 //alert(email); alert(pass);
   $.ajax({
     url: '/api/login',
     type:'POST',
     contentType:'application/json',
     data: JSON.stringify({
        email: email,
        password:pass
     }),
     success:function(response){
      console.log(response);  
      localStorage.setItem('api_token',response.token);
      window.location.href= '/allpost';
     },
     error:function(xhr,status,error){
      alert(error);   
     }
   });
  return false;
 });
});
</script>
</body>
</html>
