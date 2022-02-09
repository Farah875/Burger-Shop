<?php 
     include ('../PHP/services.php');
    session_start();

     if(isset($_GET['id']))
     {
        $id = $_GET['id'];

        if($_SESSION["loggedin"] == true)
         {
            if (!isset($_SESSION['items'])) {
                $_SESSION['items'] = array();
            }
            $_SESSION['items'][$id] = array('id' => $id , 'quantity' => 1);
             echo "<script>Item added successfuly</script>";
         }
         else{
            header( 'Location: loginForm.html');
            exit; 
         }
     }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>


    <!-- include my style sheet -->
    <link rel="stylesheet" type="text/css" href="../Styles/menu.css">
    <link rel="stylesheet" type="text/css" href="../Styles/headerandfooter.css">
    <!-- include bootstrap -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>

<!-- header -->

<div id="header">
        <img src="../Assests/logo.png">
        <h1>FOR BURGER LOVERS</h1>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="#">Burger Place</a>
                <button class="navbar-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>  
                </button>
              </div>
              <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="about.php">About Us</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="LoginForm.html"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="LoginForm.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </nav>
    </div>

       <div id="contents">
           <h1>Our Menu</h1>
       <ul class="list-group">
            <?php retrieveMenuItems() ?>
        </ul> 
       </div> 


       <div id="btn">
        <button id="menuBtn" ><b>VIEW CART</b></butto>
        </div>

    <div class="footer">

    <img src="../Assests/logo.png">
      <div id="follow">
        <h3>Follow us</h3>
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-instagram"></a>
        <a href="#" class="fa fa-pinterest"></a>
      </div>
    </div>

    <!-- <script src="../Scripts/jquery-3.5.1.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="../Scripts/jquery_validate.js"></script> -->
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- using jquery for the toggle menu -->

    <script>
       
        $("documnet").ready(function(){
            $(".navbar-toggle").click(function(){
              $(".nav").toggleClass('show');
            });

            //if add clicked call the php with is of element    
            $(".addBtn").click(function(){
                window.location = "menu.php?id="+$(this).attr("id");
            });

            $("#menuBtn").click(function(){
              location.href = "cart.php";
            });

        });
    </script>
    
</body>
</html>