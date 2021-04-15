<?php
    session_start();
    if (session_unset() && session_destroy()) {
        print("<h2>You have been successfully logged out. Redirecting...</h2>");
    } else {
        print("<h2>You are not logged in. Redirecting...</h2>");
    }
    
    //sleep(2);
    header('Location: '.$_SERVER["HTTP_REFERER"]);
?>