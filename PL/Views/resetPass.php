<?php
include ('../../BLL/userManager.php');
if(isset($_GET['hash']))
{

    $token = $_GET['hash'];
        $email= $_GET['email'];
    if(isset($_POST['password']))
    {
        $password = $_POST['password'];
        $password = Password_encryption($password);
        

        echo "<script>
        alert($password);
        </script>"; 

        if(resetPassword($token,$email,$password))
        {
            echo "congrats you can now login";
             header( 'Location: ../Views/LoginForm.html');

        }
        else{
            echo "<script>
                        alert('Sorry something went wrong please try again later');
                    </script>";
        }
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <style>
        body,html{
            background-repeat: no-repeat;
            background-color:  #231e24;
            background-position: center;
            background-size: cover;
            color: #F3D307;
            height: 75%;
        }
        .container {
            margin-top: 15%;
            /*margin-left: 20%;*/
        }
        .btn-primary{
            color: white;
            background-color: #F3D307 ;
            margin-top: 23px;
        }

        form .error{
            color: red;
        }
    </style>
</head>
<body>


<div class="container">
    <form class="row g-3" method="post" action="resetPass.php?email=farahfzeidan@gmail.com&hash=fc49306d97602c8ed1be1dfbf0835ead">
        <div class="col-auto">
            <label for="inputPassword2" >New Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword2" placeholder="Password">
        </div>
        <div class="col-auto">
            <label for="inputPassword2" >Confirm Password</label>
            <input type="password" name="conpass" class="form-control" id="inputPassword2" placeholder="Confirm Password">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Confirm password</button>
        </div>
    </form>
</div>



</body>
<script>
    $(document).ready(function () {
        $('#mailForm').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 7,
                    maxlength: 15
                },
                conpass: {
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: "Please provide a password",
                    minlength: "password can't be shroter than 7 characters",
                    maxlength: "password can't be greater than 15 characters"
                },
                conpass:{
                    equalTo: "passwords should match"
                }
            }
        });

    });
</script>

</html>



