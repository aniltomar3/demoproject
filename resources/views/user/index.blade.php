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
   <div class="container">
      @if(session('status'))
       <div class="alert alert-success"> {{ session('status') }} </div>
      @endif
      <a href="{{ route('user.create') }}" class="btn btn-success btn-sm mb-3" >Add New User</a>
     <h1> All Users list </h1>
   <table>
      <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Email</th>
         <th>View</th>
         <th>Edit</th>
         <th>Delete</th>
      </tr>  
   @foreach($data as $key=>$val)    
   <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$val->name}}</td>
      <td>{{$val->email}}</td>
      <td><a href="{{ route('user.show',$val->id) }}" class="btn btn-primary btn-sm"> View </a></td>
      <td><a href="{{ route('user.edit',$val->id)}}" class="btn btn-warning btn-sm">Edit</a></td>
      <td>
      <form action="{{ route('user.destroy',$val->id)}}" method="POST">
         @csrf
         @method('DELETE')
         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete record?')"> Delete </button>
      </form> 
      </td>
    </tr>   
   @endforeach

   </table>
   <div> {{ $data->links('pagination::bootstrap-5') }} </div>
   </div>    

</body>
</html>
   