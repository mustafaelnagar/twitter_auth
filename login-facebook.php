<?php

require 'facebook/facebook.php';
require 'config/fbconfig.php';
require 'config/functions.php';

$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            'cookie' => true
        ));

$session = $facebook->getSession();
# req_perms is a comma separated list of the permissions needed
$url = $facebook->getLoginUrl();
if (!empty($session)) {
    # Active session, let's try getting the user id (getUser()) and user info (api->('/me'))
    try {
        $uid = $facebook->getUser();
        $user = $facebook->api('/me','GET');
        $url='http://viewgrid.php';
        header("location:$url");
###########################################################################
    echo "Name: " . $user_profile['name'];
         echo $user_profile[name]."<br/>";
        echo $user_profile[id]."<br/>";
        echo $user_profile[picture]."<br/>";
        
        //load the sessions data
        $_SESSION['fb_id']=$user_profile[id];
        $_SESSION['fb_name']=$user_profile[name];
        $_SESSION['fb_name']=$user_profile[picture];
        //insert him if he is @ the database
        //check if the user already exists @ the data base 
$query="INSERT INTO `qeeratco_arrested`.`users_fb` (`id`, `fb_id`, `fb_name`, `time_joined`) VALUES ('', '{$_SESSION['fb_id']}', '{$_SESSION['fb_name']}', CURRENT_TIMESTAMP))";
echo $query;

    if(isset($_SESSION['fb_id']) and isset($_SESSION['fb_name'])){
        //redirect
        $url='viewgrid.php';
        header("location:$url");
    
    }
#########################################################################
/*********************************/

    } catch (Exception $e) {


header("Location: " . "test.com");

    }

    if (!empty($user)) {
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
        echo '<pre>';
        //print_r($user);
        echo '</pre><br/>';
        $username = $user['name'];
        $user = new User();
        $userdata = $user->checkUser($uid, 'facebook', $username);
        if(!empty($userdata)){
            session_start();
            $_SESSION['id'] = $userdata['id'];
 $_SESSION['oauth_id'] = $uid;

            $_SESSION['username'] = $userdata['username'];
            $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
            header("Location: http://home.php");
        }
    } else {
        # For testing purposes, if there was an error, let's kill the script
        die("There was an error.");
    }
} else {
    # There's no active session, let's generate one
    $login_url = $facebook->getLoginUrl(

        'req_perms' => 'email',
    'next' => 'http://localhost.com/thanks.php',
    'cancel_url' => 'http://localhost.com/sorry.php'
    );
    header("Location: " . $login_url);
}
?>
