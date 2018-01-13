
/**
 * Created by PhpStorm.
 * User: Zerina
 * Date: 12.01.2018.
 * Time: 16:20
 */
<html>
<head>
    <title> Verification </title>
</head>
<body>


<p> Please click to <a href='{{url("/register/verify/{$user -> email_token}")}}'> the link </a> in order to
    verify your email address!</p>


</body>

</html>