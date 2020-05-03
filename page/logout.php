<?php
    session_start();
    $destroy=session_destroy();
    if($destroy){
        echo "Logout Success";
    }
?>