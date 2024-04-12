<?php
include 'layout/sessioncheck.php';
include '../../constant.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $itemId = $_POST['id'];

        $sql = "UPDATE inventory SET active = 1 WHERE id = $itemId";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Item deactivated successfully";
        } else {
            echo "Error deactivating item: " . mysqli_error($conn);
        }
    } else {
        echo "Item ID not provided";
    }
} else {
    echo "Invalid request method";
}
?>
