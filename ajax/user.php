<?php

include '../constant.php';


$Name = $_POST['Name'];
$Number = $_POST['Number'];


$sql = "INSERT INTO bulk (name, mobile) VALUES ('$Name', '$Number')";
if (mysqli_query($conn, $sql)) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);
?>
