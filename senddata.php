<?php 

include 'config.php';

$name = $_POST['sName'];
$class = $_POST['sClass'];
$age = $_POST['sAge'];

$query = "INSERT INTO `students` ( `name`, `class`, `age`) VALUES ( '{$name}', '{$class}','{$age}')";
$res = mysqli_query($conn, $query);


?>