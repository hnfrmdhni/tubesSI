<?php 
include('keDatabase.php');
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$id_anggota = $_POST['id_anggota'];

$sql = "UPDATE anggota_bpjs SET  nama='$nama' , jenis_kelamin= '$jenis_kelamin', tanggal_lahir='$tanggal_lahir' WHERE id_anggota='$id_anggota' ";
$query= mysqli_query($con,$sql);
$lastid = mysqli_insert_id($con);
header("location:main.php");
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