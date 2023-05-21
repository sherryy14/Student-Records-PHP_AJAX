<?php 
include 'config.php';

$query = "SELECT * FROM `students`";
$res = mysqli_query($conn, $query);

$output ='';

if(mysqli_num_rows($res)>0){
    while($row = mysqli_fetch_array($res)){
        $output .= "
        <tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['class']}</td>
        <td>{$row['age']}</td>
        <td><button class='btn btn-outline-danger btns' data-id='{$row['id']}'>DELETE</button></td>
        </tr>
        ";
    }
}

echo $output;
?>