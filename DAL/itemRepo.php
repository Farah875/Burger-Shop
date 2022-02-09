<?php

include('connection.php');

    function getALlItems()
    {
        $conn = OpenCon();
        $query = "SELECT * FROM item";

        $result = mysqli_query($conn,$query);

        if(!$result)
        {
            die('Query failed !!! ');
        }
        
        return $result;
    }


    function getItem( $idItem )
    {
        $conn = OpenCon();
        $query = "SELECT * FROM item where id = '$idItem'";

        $result = mysqli_query($conn,$query);

        if(!$result)
        {
            return false;
        }
        
        return $result;  
    }


    function addNewOrder($email)
    {
        $date = date("Y/m/d");



        $conn = OpenCon();
        // $query1 = "SELECT id from user where email = $email";
        // $result1 = mysqli_query($conn,$query1);
        // $id = mysqli_fetch_assoc($result1);

        $stmt1 = $conn->prepare("SELECT id FROM user where email = ?;");
        $stmt1 -> bind_param("s",$email);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $row1= mysqli_fetch_assoc($result1);
        $id= $row1['id'];



         $query = "INSERT INTO orders(date,userID) values ($date,$id);";
        mysqli_query($conn,$query);

        $query2 = "select max(id) from orders";
        $result = mysqli_query($conn,$query2);
        $row = mysqli_fetch_assoc($result);
        $id = $row['max(id)'];
        return $id; 




        $conn->close();
    }


    function addNewItem($id, $quantity,$idOrder,$price)
    {
        $con= OpenCon();
        $query = "INSERT INTO orderItem(itemID,orderID,quantity, total_price) values ($id,$idOrder,$quantity,$price);";
        mysqli_query($con,$query);

        $con->close();
        
    }


?>
