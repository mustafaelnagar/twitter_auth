<?php

require 'dbconfig.php';

class User {

    function checkUser($uid, $oauth_provider, $username) 
	{
        //check if the user exists at the database 
        #like check authentication logging
        
        $query = mysql_query("SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die("error at functions.php ".mysql_error());
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
            # User is already present
        } else {
            #user not present. Insert a new Record
            #like regestration
            $query = mysql_query("INSERT INTO `users` (oauth_provider, oauth_uid, username) VALUES ('$oauth_provider', '$uid', '$username')") or die(mysql_error());
            $query = mysql_query("SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
            $result = mysql_fetch_array($query);
            return $result;
        }
        return $result;
    }

    

}

?>
