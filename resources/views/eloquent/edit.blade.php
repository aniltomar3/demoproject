<!Doctype Html>
<html>
   <head>
      <title></title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <style>
    svg.w-5.h-5{ display: none; }
   </style> 
   </head>
<body> 
   <a href="{{ route('student.index') }}" class="btn btn-success btn-sm mb-3" >Show Student</a>
   <div class="container">
     <div class="row">
        <div class="col-4">
         <h1>Add new user</h1>
         @php 
        // if($errors->any()):
        // echo "<pre>"; print_r($errors->all());
        // endif;   
         @endphp
         <form action="{{ route('student.update',$student->id) }}" method="POST">
           @csrf 
           @method('PUT')
           <div class="mb3">
            <label class="form-label">Name</label>
            <input type="text" name="username" name="username" value="{{ $student->name }}" />
            <span class="text-danger">
               @error('username')
                 {{ $message }}
               @enderror
            </span>
           </div>
           <div class="mb3">
            <label class="form-label">Email</label>
            <input type="text" name="useremail" name="useremail" value="{{ $student->stu_email }}" />
            <span class="text-danger">
               @error('useremail')
                 {{ $message }}
               @enderror
            </span>
           </div>
           <div class="mb3">
            <label class="form-label">City</label>
            <input type="text" name="usercity" name="usercity" value="{{ $student->city }}" />
            <span class="text-danger">
               @error('usercity')
                 {{ $message }}
               @enderror
            </span>
           </div>
            <div class="mb3">
            <label class="form-label">Address</label>
            <textarea name="useraddress" >{{ $student->address }}</textarea>
            <span class="text-danger">
               @error('useraddress')
                 {{ $message }}
               @enderror
            </span>
           </div>
          
           <div class="mb3">
            <input type="submit" name="sub" class="btn btn-primary" value="SUBMIT" />
           </div> 
         </form>   
        </div>
     </div> 

   </div>
</body>
</html>      