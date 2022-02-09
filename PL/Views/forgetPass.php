<?php
    include ('../../BLL/sendMail.php');
    include ('../../BLL/userManager.php');

    session_start();
    if(isset($_POST['email']))
    {
        $email = $_POST['email'];
        $result = CheckEmailExist($email);
        if($user = mysqli_fetch_array($result))
        {
            $username= $user['username'];
            $token= $user['token'];
            if(sendReset($email, $username,$token))
            {
                $_SESSION["email"] = $email;

                echo "<script>
                    alert('Check your inbox to reset your password');
                </script>";
            }
            else
            {
                echo "<script>
                    alert('Error sending the email for reset');
                </script>";
            }
        }
        else{
            echo "<script>
                    alert('Sorry this email does not exist try signing in');
                </script>";
        }


    }

    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
        }
        .btn-primary{
            color: white;
            background-color: #F3D307 ;
            margin-top: 10px;
        }

        form .error{
            color: red;
        }
    </style>
</head>
<body>


<div class="container">
    <div class="mb-3">
        <form id="mailForm" method="post" action="forgetPass.php" >
        <label for="exampleFormControlInput1" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            <button type="submit" class="btn btn-primary mb-3">Confirm identity</button>
        </form>
    </div>
</div>



</body>
    <script>
        $(document).ready(function () {
            $('#mailForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: "Please provide an email",
                        email: "Please enter a valid email address"
                    }
                }
            });

        });
    </script>

</html>

