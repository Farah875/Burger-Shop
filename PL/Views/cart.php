<?php 
     include ('../PHP/services.php');
    session_start();

if(isset($_GET['id']))
{
    $idAction = $_GET['id'];
    $action = $_GET['action'];


    foreach($_SESSION["items"] as $keys => $values)
    {
        if($idAction == $values['id'])
        {
            if($action == 1)
            {
                $values['quantity'] ++ ;
                //fillTable();
            }
            else {
                if($action == 0)
                {
                    if (!$values['quantity'] == 0)
                    
                    $values['quantity'] -- ;
                   // fillTable();
                }
                else {
                    if($action == -1)
                    {
                        $values['quantity'] = 0 ;
                      //  fillTable();
                    }
                }
            }
            

        }
    }

}

function fillTable()
{
    if(!empty($_SESSION["items"]))  
    {  
        $total = 0;  
        foreach($_SESSION["items"] as $keys => $values)  
        {  
            $result = getOneItem($values['id']);
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            ?>  
            <tr>  
                <td><?php echo $row['name']; ?></td>  
                <td><?php echo $values['quantity']; ?> <a id= <?php echo $id;?> class="more">  more+</a><a id= <?php echo $id;?> class="less">   less-</a></td>  
                <td>$ <?php echo $row['price']; ?></td>  
                <td>$ <?php echo number_format($values['quantity'] * $row['price'], 2); ?></td>  
                <td><a id= <?php echo $id;?> class="remove"><span class="text-danger">Remove</span></a></td>  
            </tr>  
            <?php  
            $total = $total + ($values['quantity'] * $row['price']);  
        }  
    ?>  
    <tr>  
        <td colspan="3" align="right">Total</td>  
        <td align="right">$ <?php echo number_format($total, 2); ?></td>  
        <td></td>  
    </tr>  
    <?php  
    }
}
     

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>


    <!-- include my style sheet -->
    <link rel="stylesheet" type="text/css" href="../Styles/menu.css">
    <link rel="stylesheet" type="text/css" href="../Styles/headerandfooter.css">
    <!-- include bootstrap -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .footer{
    height: 100px;
    width: 100%;
    padding: 10px;
    background-color: #212121;
    position: fixed;
  left: 0;
  bottom: 0;
}
    </style>

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
                <!-- <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Burgers <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Page 1-1</a></li>
                    <li><a href="#">Page 1-2</a></li>
                    <li><a href="#">Page 1-3</a></li>
                  </ul>
                </li> -->
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

    <h1>
        Your Cart:
    </h1>

    <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                            fillTable();
                          ?>  
                     </table>  
                </div>  


       <div id="btn">
        <button id="menuBtn" ><b>Generate invoice</b></butto>
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
              location.href = "invoice.php";
            });

            //if user want to increase the quantity call the cart.php to add the value
            $(".more").click(function(){
                window.location = "cart.php?id="+$(this).attr("id")+"&action=1";
            });
            

            //if user want to decrease the quantity call the cart.php to decrease the value..
            $(".less").click(function(){
                window.location = "cart.php?id="+$(this).attr("id")+"&action=0";
            });


            $(".remove").click(function(){
                window.location = "cart.php?id="+$(this).attr("id")+"&action=-1";
            });

        });
    </script>
    
</body>
</html>