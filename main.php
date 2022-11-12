<?php include('keDatabase.php'); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/datatables.min.css" />
  <title>Sistem Informasi Rekam Medis</title>
  <style type="text/css">
    .btnAdd {
      text-align: right;
      width: 83%;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <h1 class="text-center mt-3">Selamat Datang di Sistem Informasi Rekam Medis</h1>
    <h3 class="datatable design text-center mt-3">Daftar Anggota BPJS</h3>
    <div class="row">
      <div class="container">
        <div class="btnAdd">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal"
            class="btn btn-success btn-sm">Tambah Anggota</a>
        </div>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table id="example" class="table">
              <thead>
                <th>Id Anggota</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Options</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/datatables.min.js"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
  <script type="text/javascript">
    $(document).ready(function () {
      $('#example').DataTable({
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
          $(nRow).attr('id_anggota', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [4]
          },

        ]
      });
    });
    $(document).on('submit', '#addUser', function (e) {
      e.preventDefault();
      var nama = $('#addNamaField').val();
      var tanggal_lahir = $('#addTanggalLahirField').val();
      var jenis_kelamin = $('#addJenisKelaminField').val();
      if (nama != '' && tanggal_lahir != '' && jenis_kelamin != '') {
        $.ajax({
          url: "add_user.php",
          type: "post",
          data: {
            nama: nama,
            tanggal_lahir: tanggal_lahir,
            jenis_kelamin: jenis_kelamin
          },
          success: function (data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              mytable = $('#example').DataTable();
              mytable.draw();
              $('#addUserModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $(document).on('submit', '#updateUser', function (e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var nama = $('#namaField').val();
      var tanggal_lahir = $('#tanggallahirField').val();
      var jenis_kelamin = $('#jeniskelaminField').val();
      var trid = $('#trid').val();
      var id_anggota = $('#id_anggota').val();
      if (nama != '' && tanggal_lahir != '' && jenis_kelamin != '') {
        $.ajax({
          url: "update_user.php",
          type: "post",
          data: {
            nama: nama,
            tanggal_lahir: tanggal_lahir,
            jenis_kelamin: jenis_kelamin,
            id_anggota: id_anggota
          },
          success: function (data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#example').DataTable();
              // table.cell(parseInt(trid) - 1,0).data(id);
              // table.cell(parseInt(trid) - 1,1).data(username);
              // table.cell(parseInt(trid) - 1,2).data(email);
              // table.cell(parseInt(trid) - 1,3).data(mobile);
              // table.cell(parseInt(trid) - 1,4).data(city);
              var button = '<td><a href="javascript:void();" data-id="' + id_anggota +
                '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id_anggota +
                '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id_anggota, nama, jenis_kelamin, tanggal_lahir, button]);
              $('#exampleModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $('#example').on('click', '.editbtn ', function (event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id_anggota = $(this).data('id_anggota');
      $('#exampleModal').modal('show');

      $.ajax({
        url: "get_single_data.php",
        data: {
          id_anggota: id_anggota
        },
        type: 'post',
        success: function (data) {
          var json = JSON.parse(data);
          $('#namaField').val(json.nama);
          $('#jeniskelaminField').val(json.jenis_kelamin);
          $('#tanggallahirField').val(json.tanggal_lahir);
          $('#id_anggota').val(id_anggota);
          $('#trid').val(trid);
        }
      })
    });

    $(document).on('click', '.deleteBtn', function (event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id_anggota');
      if (confirm("Are you sure want to delete this User ? ")) {
        $.ajax({
          url: "delete_user.php",
          data: {
            id_anggota: id_anggota
          },
          type: "post",
          success: function (data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#example tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              $("#" + id_anggota).closest('tr').remove();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    })
  </script>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id_anggota" id="id_anggota" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="namaField" class="col-md-3 form-label">Nama</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="namaField" name="nama">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="jeniskelaminField" class="col-md-3 form-label">Jenis Kelamin</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="jeniskelaminField" name="jenis_kelamin">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tanggallahirField" class="col-md-3 form-label">Tanggal Lahir</label>
              <div class="col-md-9">
                <input type="date" class="form-control" id="tanggallahirField" name="tanggal_lahir">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add user Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addUser" action="">
            <div class="mb-3 row">
              <label for="addNamaField" class="col-md-3 form-label">Nama</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addNamaField" name="nama">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addJenisKelaminField" class="col-md-3 form-label">Jenis Kelamin</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addJenisKelaminField" name="jenis_kelamin">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addTanggalLahirField" class="col-md-3 form-label">Tanggal Lahir</label>
              <div class="col-md-9">
                <input type="date" class="form-control" id="addTanggalLahirField" name="tanggal_lahir">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script type="text/javascript">
  //var table = $('#example').DataTable();
</script>