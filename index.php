<?php

    include("functions.php");

    include("views/header.php");

    if (isset($_GET['page']) && ($_GET['page'] == 'timeline')) {

        include("views/timeline.php");

    } else {

        include("views/home.php");

    }
    
    include("views/footer.php");    

?>