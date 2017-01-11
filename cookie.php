<!DOCTYPE html>
<html>
<head>
    <script src="cookie.js" type="text/javascript"></script>
</head>
<body>
   <?php if(isset($_COOKIE['UsersName']))
    {
    echo "Hello, ".$_COOKIE['UsersName']."! Welcome back!";
    }
    else
    {
    setcookie("UsersName",$name);
    }?>
</body>
</html>