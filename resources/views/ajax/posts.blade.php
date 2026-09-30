<h3>All posts here</h3>
<a href="{{ route('addpost') }}">Add Post</a>
<button id="logoutBtn"> Logout </button>
<div id="postContainer"></div>

<script>
document.querySelector('#logoutBtn').addEventListener('click',function(){
   const token= localStorage.getItem('api_token');
   fetch('/api/logout',{
        method :'POST',
        headers:{ 'Authorization':`Bearer ${token}` }

   }).then(response=>response.json()).then(data=>{ console.log(data); window.location.href= '/ajaxform';})
});

function loadData(){
   const token= localStorage.getItem('api_token');
      fetch('/api/posts',{
            method :'GET',
            headers:{ 'Authorization':`Bearer ${token}` }

         }).then(response=>response.json()).then(data=>{
            // console.log(data.data); 
            var allPost= data.data;
            const postContainer= document.querySelector('#postContainer');
    var tableData= `<table>
               <tr>
                  <th>id</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Images</th>
                  <th>update</th>
                  <th>Delete</th>
               </tr>`;   
            allPost.forEach(post=>{
            tableData +=   `<tr>
                  <td>${post.id}</td>
                  <td>${post.title}</td>
                  <td>${post.description}</td>
                  <td><img src="/apimage/${post.image}" /> </td>
                  <td><a href="javascript:void(0)" onclick="deletePost(${post.id})">Update</a></td>
                  <td><a href="javascript:void(0)" onclick="deletePost(${post.id})">Delete</a></td>
               </tr>`;               
            });
            tableData += '</table>';
            postContainer.innerHTML= tableData;
      });      
   }
loadData();   

//Delete Post
async function deletePost(postID){
   const token= localStorage.getItem('api_token'); 
   let response= await fetch(`/api/posts/${postID}`,{
     method:'DELETE',
     headers:{
      'Authorization':`Bearer ${token}`,
     }

   }).then(response=> response.json()).then(data =>{  console.log(data); window.location.href = '/allpost';})
}
</script>

