<?php

require("twitter/twitteroauth.php");
require 'config/twconfig.php';
require 'config/functions.php';
  session_start();

if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
    // We've got everything we need
    $twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
    $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
    $_SESSION['access_token'] = $access_token;
// Let's get the user's info
    $user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
    echo '<pre>';
   //  print_r($user_info);
    echo '</pre><br/>';



    $img;
    $scree_name;
    $username;
    $uid;
    if (isset($user_info->error)) {
        // Something's wrong, go back to square 1  
        header('Location: login-twitter.php');
    } else {
        $uid = $user_info->id;
        $username = $user_info->name;
        $img = $user_info->profile_image_url;
        $screen_name = $user_info->screen_name;

        //create a new object
        $user = new User();
         //check user at the function.php

        $userdata = $user->checkUser($uid, 'twitter', $username);

        if(!empty($userdata)){
         //   session_start();
         //user data is simple associative array contain info from database 

            $_SESSION['id'] = $userdata['id'];
			$_SESSION['screen_name'] = $userdata['screen_name'];
			
             $_SESSION['oauth_id'] = $uid;
             $_SESSION['username'] = $userdata['username'];
             $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
             $_SESSION['screen_name'] = $userdata['screen_name'];
			
        }
    }
} else {
    // Something's missing, go back to square 1
    header('Location: login-twitter.php');
}
$url="http://127.0.0.1/rungears.com/?social='true'&uname=".$_SESSION['username']."&id=".$_SESSION['id']."&screen=". $_SESSION['screen_name']."&img=".$img;
header('Location: ' .$url );
?>
