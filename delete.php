<?php
include 'config.php';

$id = $_POST['id'];

$query = "DELETE FROM `students` WHERE id = '{$id}'";
$result = mysqli_query($conn, $query);

if($result){
    echo true;
}else{
    echo false;

}

?>