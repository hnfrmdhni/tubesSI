<?php 
include('keDatabase.php');
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];

$sql = "INSERT INTO `anggota_bpjs` (`nama`,`jenis_kelamin`,`tanggal_lahir`) values ('$nama', '$jenis_kelamin', '$tanggal_lahir' )";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{

    $data = array(
        'status'=>'true',
    
    );

    echo json_encode($data);
}
else
{
    $data = array(
        'status'=>'false',
    
    );

    echo json_encode($data);
} 

?>