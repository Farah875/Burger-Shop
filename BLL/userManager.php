<?php


include('..\..\DAL\userRepository.php');

function SignUp($username,$phoneNumber,$email,$password,$token)
{

        InsertUser($username, $phoneNumber,$email,$password,$token);
        return true;

}

function login($email,$password)
{
    $result =  userLogin($email,$password);

    if(mysqli_num_rows($result)<=0)
    {
        return false;
    }
    else{
        return true;
    }

}

function activateAccount ($email,$token)
{
    if(setToken($email,$token))
    {
        return true;
    }
    return false;
}

function resetPassword( $token, $email, $password)
{
    if(updatePassword($token, $email, $password))
        return true;
    else return false;

}



?>