<?php
//Always place this code at the top of the Page
session_start();
if (isset($_SESSION['id'])) {
    // Redirection to login page twitter or facebook
    header("location: home.php");
}

if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
        header("Location: login-twitter.php");
    } else if ($oauth_provider == 'facebook') {
        header("Location: login-facebook.php");
    }
}
?>
<title>OnlineWebApplication Facebook | Twitter Login</title>
<style type="text/css">
    #buttons
	{
	text-align:center
	}
    #buttons img,
    #buttons a img
    { border: none;}
	h1
	{
	font-family:Arial, Helvetica, sans-serif;
	color:#999999;
	}
	
</style>



<div id="buttons">
<h1>Twitter Facebook Login </h1>
    <a href="?login&oauth_provider=twitter">
<?php

//$log_url="http:local.run.com/rungears.com/thirdparty/tw/index.php"."?login&oauth_provider=twitter";
$log_url="http://local.run.com/rungears.com/Login_Twitbook/rot/?login&oauth_provider=twitter";
 header('location:'.$log_url);
 ?>
    <img src="images/tw_login.png"></a>&nbsp;&nbsp;&nbsp;
    

    <a href="?login&oauth_provider=facebook"><img src="images/fb_login.png"></a> <br />
	<br />
	<a href="http://onlinewebapplication.com/">http://onlinewebapplication.com/</a>   
</div>
