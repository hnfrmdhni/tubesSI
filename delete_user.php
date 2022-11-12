<?php 
include('keDatabase.php');

$id_anggota = $_GET['id_anggota'];
$sql = "DELETE FROM anggota_bpjs WHERE id_anggota = '$id_anggota'";
$delQuery =mysqli_query($con,$sql);
if($delQuery==true)
{
	$data = array(
        'status'=>'success',
        
    );

    echo json_encode($data);
}
else
{
    $data = array(
        'status'=>'failed',
    
    );

    echo json_encode($data);
} 

?>