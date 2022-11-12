<?php include('keDatabase.php');
$id_anggota = $_POST['id_anggota'];
$sql = "SELECT * FROM anggota_bpjs WHERE id_anggota='$id_anggota' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
