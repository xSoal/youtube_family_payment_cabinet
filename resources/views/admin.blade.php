<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">

</head>
<body>


<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();

if($user->is_admin !== 1){
    header('Location:/');
    die();
}

?>
<input id="user_token" value="{{ $user_token  }}" type="hidden" >

<div id="admin"></div>




<script src="{{ asset('/js/admin.js') }}" defer></script>
</body>
</html>
