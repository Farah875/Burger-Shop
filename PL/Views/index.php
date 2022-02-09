<?php

  include ('../PHP/services.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger Place</title>
    <!-- include my style sheet -->
    <link rel="stylesheet" type="text/css" href="../Styles/index.css">
    <link rel="stylesheet" type="text/css" href="../Styles/headerandfooter.css">
    <!-- include bootstrap -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
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


    <div id="carousel">
      <div class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
      
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img src="../Assests/c1.jpg" style="width:100%; height: 500px;">
            </div>
      
            <div class="item">
              <img src="../Assests/c2.jpg" style="width:100%; height: 500px;">
            </div>
          
            <div class="item">
              <img src="../Assests/c3.jpg"  style="width:100%; height: 500px;">
            </div>
          </div>
      
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>


    <div id="bodyCards">
      <div class="row">
        <?php 
              retrieveItemsIndex();
        ?>
      </div>
    </div>


    <div id="btn">
        <button id="menuBtn" ><b>VIEW MENU</b></butto>
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


            $("#menuBtn").click(function(){
              location.href = "menu.php";
            });
          });
    </script>
</body>
</html>