<html>
<head>
   <title></title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
   <div class="container-fluid"> 
   <div class="row">
       <h2>Add Post</h2>
         <form action="" id="addFrm">
         @csrf
               <div class="form-group col-md-6">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title"  placeholder="Enter title">
               </div>
               <div class="form-group col-md-6">
                  <label for="description">Description</label>
                  <textarea id="description" name="description" rows="2" ></textarea>
               </div>
               <div class="form-group col-md-12">
                  <label for="image">Image</label>
                 <input type="file" id="image" name="image" value="" />
               </div>
               <div class="form-group col-md-6">
                     <button type="submit" class="btn btn-primary" id="addPost"> Add Post </button>
               </div>  
        </form>
      </div>     
   </div>    
</body>
<script>
   var addForm= document.querySelector('#addFrm');
   addForm.addEventListener('submit', async(e)=>{
      e.preventDefault();
     const token= localStorage.getItem('api_token');
     const title=       document.querySelector('#title').value;
     const description= document.querySelector('#description').value;
     const image=       document.querySelector('#image').files[0];

     var formData= new FormData();
     formData.append('title',title);
     formData.append('description',description);
     formData.append('image',image);
     
     let response= await fetch('/api/posts',{
         method:'POST',
         body: formData,
         headers:{
            'Authorization':`Bearer ${token}`,
         }
     }).then(response=>response.json()).then(data=>{  window.location.href= '/allpost';  });
   });

</script>   
</html>   