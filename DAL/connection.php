<?php


function OpenCon()
{
    $url = '127.0.0.1:3305';
    $username = 'farah';
    $password = 'farah0021';
    $con = mysqli_connect($url, $username, $password, "projectwebburger");
    if (!$con) {
        die('Could not Connect My Sql:' . mysql_error());
        return null;
    }
    return $con;
}

function CloseCon($con)
{
    mysqli_close($con);
}

?>