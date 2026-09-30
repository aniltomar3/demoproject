<!DOCTYPE HTML>
<html>
<head>
<title>File Upload</title> 
</head>
<body>
<form name="form1" action="{{ route('user.upload') }}" method="POST" enctype="multipart/form-data">
@csrf
<input type="file" name="photo" value="" />
<input type="submit" name="submit" value="SUBMIT" />
@error('photo')
<div>{{ $message }} </div>
@enderror

@if(session('status'))
{{ session('status') }}
@endif
</form>  
</body>
</html>
