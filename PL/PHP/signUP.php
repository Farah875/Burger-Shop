<?php
include('../../BLL/userManager.php');
include ('../../BLL/sendMail.php');

session_start();

if ($_POST['action'] == "signup") {


    error_log("Method Signup initiated");

    $errors = array();
    $form_data=array();


    $username = $_POST['username'];
    $username = stripslashes($username);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pass = $_POST['password'];

    if(!ValidateUsername($username))
    {
        $errors['name'] = 'Username cant  be blank';
    }

    if (!ValidatePhone($phone))
    {
        $errors['name'] = 'Phone number cant contain characters';
    }

    if(!ValidatePassword ($password))
    {
        $errors['name'] = 'Password should be strong';
    }

    if(!ValidateEmail( $email))
    {
        $errors['name'] = 'Email exists please try a different email or login';
    }


    if (empty($errors)) { //If no errors in validation
        $password = Password_encryption($pass);
        $token =  md5( rand(0,1000) );
        $result = SignUp($username,$phone,$email,$password,$token);
        if (!$result) {
            $errors['name'] = 'Error adding user, try again later';
        }
        else{
           $verify =  sendVerification($email,$username,$token);

            if(!$verify)
                $errors['name'] = 'Unable to send verification email please try again';

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

    error_log("sleeping 5 seconds!");
    sleep(5);

    error_log(json_encode($form_data));
    error_log("Method signup finished");
    echo json_encode($form_data);



}


function ValidatePassword($password)
{
    if( $password == null || $password == '' || strlen($password) <= '4' || strlen($password) >15 ||
        (!preg_match("#[0-9]+#", $password)) || (!preg_match("#[A-Z]+#",$password))
        || (!preg_match("#[a-z]+#",$password)))
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
            return true;
        else
            return false;
    }

}

function ValidateUsername($username)
{
    if ($username == null || $username == '')
        return false;
    else return true;
}

function ValidatePhone($phone)
{
    if ($phone == null || $phone == '' || (!preg_match("#[0-9]+#", $phone))
        || (preg_match("#[A-Z]+#",$phone))
        || (preg_match("#[a-z]+#",$phone) ))
        return false;
    else return true;
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