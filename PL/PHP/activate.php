<?php

include('../../BLL/userManager.php');

    if(isset($_GET['hash']))
    {
        $token = $_GET['hash'];
        $email= $_GET['email'];

        if( activateAccount($email,$token))
        {
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            //echo "congrats you can now login";
           header( 'Location: ../Views/index.html');
           exit; 
        }

    }

?>
