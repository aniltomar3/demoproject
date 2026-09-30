@php 
$name= "Ronaldo";

$fruits= ['Apple','Mango','Banana','Orange'];
@endphp 

<script> 
var user= @json($name);
console.log(user);
//var data= @json($fruits);
var data= {{ Js::from($fruits)}}
data.forEach(function(val){
   console.log(val);
});
</script> 