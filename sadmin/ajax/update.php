<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST["order_id"];
    $delivery_status = $_POST["delivery_status"];

    $sql = "UPDATE orders SET delivery_status = '$delivery_status' WHERE id = $order_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Delivery status updated successfully.";
       
        
    } else {
        echo "Error updating delivery status: " . mysqli_error($conn);
    }
}

?>