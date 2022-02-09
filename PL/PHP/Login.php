<?php
include('../../BLL/userManager.php');



if ($_POST['action'] == "LOGIN") {

    session_start();
    error_log("Login method started");

    $errors = array(); //To store errors
    $form_data = array(); //Pass back the data to `form.php`

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass= stripcslashes($pass);
    $password = Password_encryption($pass);


    if(!ValidatePassword ($pass))
    {
        $errors['name'] = 'Password should not be empty';
    }

    if(!ValidateEmail( $email))
    {
        $errors['name'] = 'Email does not exist please signup first';
    }


    if (empty($errors)) { //If no errors in validation

        $result = login($email, $password);
        if ($result) {
            //if the login is successful
            // Initialize the session

            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
        }
        else {
            $errors['name'] = 'Please check password and try again';
        }

    }
        if(!empty($errors)){
            $form_data['success']=false;
            $form_data['errors'] = $errors;
        }
    else{
            $form_data['success']=true;
            $form_data['posted'] = 'Data posted successfully';
        }


        error_log("Sleeping  5 seconds!");
        sleep(5);
        //Return the data back to form.php
        error_log(json_encode($form_data));
        error_log("Method LOGIN finished!");
        echo json_encode($form_data);

}

function ValidatePassword($password)
{
    if( $password == null || $password == '' || strlen($password) <= '4' || strlen($password) >15)
        return false;
    else return true;
}

function ValidateEmail($email)
{

    if($email == null || $email == '' )
        return false;
    else{
        $result = CheckEmailExist($email);
        if(mysqli_num_rows($result)<=0)
            return false;
        else
            return true;
    }

}


function Password_encryption($password)
{
    $BlowFish_Hash_format = "$2y$10$";
    $Salt = "pssecurityisimportant$";
    $BlowFish_Hash_format_with_Salt = $BlowFish_Hash_format.$Salt;
    $Hash = crypt($password,$BlowFish_Hash_format_with_Salt);
    return $Hash;

}

?>