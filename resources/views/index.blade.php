<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Awesome contact app title</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ elixir('css/auth.css') }}" rel="stylesheet" type="text/css" />

</head>


<body class="login">
<div class="content" id="app">
    <router-view></router-view>
</div>

<div class="copyright page-footer-fixed"> 2016 &copy; Helpful stuff here </div>



<!--[if lt IE 9]>
<script src="{{ elixir('js/ie.js')}}"></script>

<![endif]-->
<script src="{{ elixir('js/app.js') }}" type="text/javascript"></script>

</body>

</html>