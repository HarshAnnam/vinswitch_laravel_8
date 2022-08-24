<!DOCTYPE html>
<html>
<head>
 <title>Vinswitch - Reset Password</title>
</head>
<body>



<h2>Hello {{$user->name}}</h2>
 <h3>Click below link to reset your password :</h3>
 <a href="{{url('resetPassword/'.encrypt($user->id))}}">Click Here</a>
</body>
</html>
