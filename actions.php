<?php

include("functions.php");

//echo "actions.php started";
//print_r($_POST);
//print_r($_GET);

if ($_GET['action'] == "loginSignup") {

        $error = "";
        $success = "1";

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


        if ($_POST['loginActive'] == "0") { //if sign-up mode enable, register user into database

            $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) > 0) $error = "That email address is already taken.";

            else {

                $password = mysqli_real_escape_string($link, $_POST['password']);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);


                $query = "INSERT INTO users (`email`, `password`) VALUES ('". mysqli_real_escape_string($link, $_POST['email'])."', '$hashed_password')";

                if (mysqli_query($link, $query)) {

                    $_SESSION['id'] = mysqli_insert_id($link);                    

                    } else {

                    $error = "Couldn't create user";

                    }

                }

            } else { // otherwise log in the user

                $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
                $result = mysqli_query($link, $query);
                $password = mysqli_real_escape_string($link, $_POST['password']);
                $row = mysqli_fetch_assoc($result); 

                    if (password_verify($password, $row['password'])) {

                        $_SESSION['id'] = $row['id'];                        

                    } else {

                        $error = "Wrong username/password";

                    }        

            }

        if ($error != "") {

            echo $error;
            exit;

        }
        

}
    if ($_GET['action'] == 'toggleFollow') {

        //print_r($_POST);
        $query = "SELECT * FROM isfollowing WHERE follower = ". mysqli_real_escape_string($link, $_SESSION['id'])." AND isFollowing = ".mysqli_real_escape_string($link, $_POST['userId'])." LIMIT 1";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0) {
         
            $row = mysqli_fetch_assoc($result); 

            mysqli_query($link, "DELETE FROM isfollowing WHERE id = ". mysqli_real_escape_string($link, $row['id'])." LIMIT 1");

            echo "1";

        } else {

            mysqli_query($link, "INSERT INTO isfollowing (follower, isFollowing) VALUES (". mysqli_real_escape_string($link, $_SESSION['id']).", ". mysqli_real_escape_string($link, $_POST['userId']).")");

            echo "2";

        }
            //$error = "That email address is already taken.";
    }

?>