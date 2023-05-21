<?php 

include 'config.php';
$sort = $_POST['sort'];




if($sort == 'idas'){
    
$query = "SELECT * FROM `students` ORDER BY id ASC";

}elseif($sort == 'idds'){
    $query = "SELECT * FROM `students` ORDER BY id DESC";
    
}elseif($sort == 'name'){
    $query = "SELECT * FROM `students` ORDER BY name ASC";

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