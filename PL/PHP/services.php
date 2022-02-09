<?php
    include('../../BLL/itemManager.php');
    // include('../../BLL/orderManager.php');

    function retrieveItemsIndex()
    {
        $result = getItemList();

        $numRow = mysqli_num_rows($result);
        for ( $counter =0; $counter < 4; $counter++)
        {
            $row = mysqli_fetch_assoc($result);
            $image = $row['imagePath'];
            $name = $row['name'];
            $desc = $row['description'];
            $price = $row['price'];
            ?>
                <div class="column">
                <!-- <div class="card"> -->
                <div class="card flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                    <img src="<?php echo $image?>" alt="Avatar" style="width:100%;height:100%;">
                    </div>
                    <div class="flip-card-back">
                    <h1><?php echo $name ?></h1> 
                    <p>Price: <?php echo $price ?></p> 
                    <p>Description: <?php echo $desc ?></p>
                    </div>
                <!-- </div> -->
                </div>
            </div>
            </div>

            <?php 
        }

        

    }


    function retrieveMenuItems()
    {
        $result = getItemList();
        while( $row =  mysqli_fetch_assoc($result))
        {
            $id = $row['id'];
            $name = $row['name'];
            $desc = $row['description'];
            $price = $row['price'];

            ?>
                <li class="list-group-item">
                <span class="badge">Add item to cart: <button class="addBtn" id=<?php echo $id?>><b>+</b></button></span>

                    <div class="listItem">
                        <h3><?php echo $name?></h3>
                        <h5>Price: <?php echo $price?></h5>
                        <h5>Description: <?php echo $desc?></h5>
                    </div>     
                </li>
            <?php

        }
    }


    function createNewOrder($id)
    {
        return createOrder($id);
    }

    function addItemToOrder($id, $quantity,$idOrder,$price){
        addOrderItems($id, $quantity,$idOrder,$price);
    }

    

?>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html> -->