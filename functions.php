<?php

    $link = mysqli_connect("localhost", "root", "password", "twitter");

    if (mysqli_connect_errno()) {

        print_r (mysqli_connect_error());
        exit;
 
    }

?>