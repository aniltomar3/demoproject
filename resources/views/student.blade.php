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
     <h1> All students list </h1>
   <table>
      <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Email</th>
         <th>Address</th>
         <th>City</th>
         <th>View</th>
         <th>Edit</th>
         <th>Delete</th>
      </tr>  
   @foreach($data as $key=>$val)    
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$val->name}}</td>
      <td>{{$val->stu_email}}</td>
      <td>{{$val->address}}</td>
      <td>{{$val->city}}</td>
      <td> <a href="{{ route('stu.singleuser',$val->id) }}"> View </a></td>
      <td><a href="">Edit</a></td>
      <td><a href="">Delete</a></td>
    </tr>   
   @endforeach

   </table>
   <div> {{ $data->links('pagination::bootstrap-5') }} </div>
   </div>    

</body>
</html>
   