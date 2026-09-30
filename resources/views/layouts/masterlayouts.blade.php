@php 
 $fruits= array();
 $value="";
 // runs only first parameter true
@endphp 
@includeWhen(empty($value),'pages.header',['fruits'=>$fruits]) 
<main>
   @yield('content')
   <aside>
    @section('sidebar')
     <ul>
      <li><a href="">Home</a></li>
      <li><a href="">About</a></li>
      <li><a href="">Post</a></li>
     </ul> 
     @show 
   </aside>   
</main>   
</div>  
@stack('scripts')  
</body>    
</html>
@includeUnless(false,'pages.footer',['name'=>'Websoftonic'])