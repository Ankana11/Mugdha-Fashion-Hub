<?php 

include '../constant.php';

if(isset($_POST['query'])){
    $output = '';
    $query = "SELECT * FROM `school` WHERE schoolname LIKE '%" . $_POST["query"] . "%'";
    $result = mysqli_query($conn, $query);
    $output = '<ul class="list-unstyled">';
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result)) {
            $output .= '<li>'.$row["schoolname"].'</li>';
        }
    } else {
        $output .= '<li>School name not found</li>';
    }
    $output .= '</ul>';
    echo $output;
}
?>
