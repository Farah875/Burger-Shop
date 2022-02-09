<?php
    include('..\..\DAL\itemRepo.php');
    


    function getItemList()
    {
        $result = getALlItems();
        if( mysqli_num_rows($result) >=1)
        {
            return $result;
        }
        else return false;
    }

    function getOneItem($id)
    {
        $result = getItem($id);
        if(mysqli_num_rows($result) >= 1)
        {
            return $result;
        }
        else return false;

    }


    function createOrder($id)
{
    $idOrder = addNewOrder($id);
    return $idOrder;
}


function addOrderItems($id, $quantity,$idOrder,$price)
{
    addNewItem($id, $quantity,$idOrder,$price);
}


?>



