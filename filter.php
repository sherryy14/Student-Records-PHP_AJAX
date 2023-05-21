<?php 

include 'config.php';
$filter = $_POST['filter'];




if($filter >=20){
    
$query = "SELECT * FROM `students` WHERE age >= '{$filter}'";
}elseif($filter <20){
    $query = "SELECT * FROM `students` WHERE age <= '{$filter}'";
}

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