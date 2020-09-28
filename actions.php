<?php

    include("functions.php");

    if ($_GET['action'] == "loginSignup") {

        $error ="";

        if (!$_POST['email']) {

            $error = "An email address is required";

        } elseif (!$_POST['password']) {

            $error = "A pasword is required";

        } elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {

            $error = "Please enter a valid email address";
}
        
        if ($error != "") {
            
            echo $error;
            exit;
        }


        if ($_POST['loginActive'] == "0") {

            $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) > 0) $error = "that email address is already taken.";

            else {

                $password = mysqli_real_escape_string($link, $_POST['password']);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);


                $query = "INSERT INTO users (`email`, `password`) VALUES ('". mysqli_real_escape_string($link, $_POST['email'])."', '$hashed_password')";

                if (mysqli_query($link, $query)) {

                    /*$query = "UPDATE users SET `password` = '". password_hash(password_hash(msqli_insert_id($link)).$_POST['password']) ."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";*/

                    echo 1;

                } else {

                    $error = "Couldn't create user";

                }
            }

        } else {

            $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            $password = mysqli_real_escape_string($link, $_POST['password']);
            $row = mysqli_fetch_assoc($result); 

                if (password_verify($password, $row['password'])) {

                    echo 2;


                } else {

                    $error = "Wrong username/password";

                }
            
            





        }

            if ($error != "") {

                echo $error;
                exit;

            }

    }

?>