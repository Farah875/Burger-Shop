<?php

include('connection.php');

function CheckEmailExist($email)
{
    $conn = OpenCon();
    $stmt = $conn ->prepare("SELECT * FROM user WHERE email =?;");
    $stmt -> bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();;
    return $result;

}

function InsertUser($username, $phoneNumber,$email,$password,$token)
{
    $conn = OpenCon();
    $stmt = $conn->prepare("INSERT INTO user(username,phoneNumber,email,password,token,status) VALUES (?,?,?,?,?,0);");
    $stmt->bind_param("sssss",$username,$phoneNumber,$email,$password,$token);
    $stmt->execute();


    $stmt->close();
    $conn->close();
}

function updatePassword ( $token, $email, $password)
{
    $conn= OpenCon();
    $stmt1 = $conn->prepare("SELECT token FROM user where email = ?;");
    $stmt1 -> bind_param("s",$email);
    $stmt1->execute();
    $result = $stmt1->get_result();
    $row = mysqli_fetch_assoc($result);
    if($row['token'] == $token)
    {
        $stmt2 = $conn->prepare("update user set password = ?  where email = ?;");
        $stmt2 -> bind_param("ss",$password,$email);
        $stmt2->execute();
        //return $stmt1->affected_rows;
        return true;
    }
    return false;
}

function getTokin($email)
{
    $conn= OpenCon();
    $stmt1 = $conn->prepare("SELECT token FROM user where email = ?;");
    $stmt1 -> bind_param("s",$email);
    $stmt1->execute();
    $result = $stmt1->get_result();
    $row = mysqli_fetch_assoc($result);
    $token = $row['token'];
    return $token;
}

function setToken($email,$token)
{
    $conn= OpenCon();
    $stmt1 = $conn->prepare("SELECT token FROM user where email = ?;");
    $stmt1 -> bind_param("s",$email);
    $stmt1->execute();
    $result = $stmt1->get_result();
    $row = mysqli_fetch_assoc($result);
    if($row['token'] == $token)
    {
        $stmt2 = $conn->prepare("UPDATE user set status = 1 where email = ?;");
        $stmt2 -> bind_param("s",$email);
        $stmt2->execute();
        return true;
    }
    return false;

}


function userLogin($email,$password)
{
    $conn = OpenCon();
    $stmt = $conn->prepare("SELECT * FROM user WHERE email= ? AND password=?; ");
    $stmt->bind_param("ss",$email,$password);
    $stmt->execute();
    $result = $stmt->get_result();

    $conn->close();

    return $result;
}


?>