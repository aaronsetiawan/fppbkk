@extends('master.app')
@section('title') Data Kompetensi Jabatan @endsection
@section('css')
<!-- DataTables -->
  <link rel="stylesheet" href="/AdminLTE/plugins/datatables/dataTables.bootstrap4.css">
<!-- Select2 -->
  <link rel="stylesheet" href="/AdminLTE/plugins/select2/select2.min.css">
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kompetensi Jabatan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Kompetensi Jabatan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Kompetensi Jabatan {{$jab_now[0]->nama_jabatan}}
            <div style="float: right; margin-bottom: 20px">
              <button id="tambah" type="button" class="btn btn-block btn-sm btn-primary" style="padding-top: 2px; padding-bottom: 2px">+ Tambah</button>
            </div>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if($all->count())
          <table id="tabel-kompetensi-jabatan" class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Kompetensi</th>
                <th>Level</th>
                <th>Kompetensi Pendahulu</th>
                <th width="5%"></th>
                <th width="5%"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($all as $a)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$a->nama_kompetensi}}</td>
                <td>{{$a->level_kompetensi}}</td>
                <td>{{$a->nama_kompetensi_pendahulu}}</td>
                <td><button id="edit" data-id="{{$a->id_kompetensi_jabatan}}" data-idjab="{{$id_now}}" type="button" class="btn btn-block btn-warning btn-sm"><span class="fa fa-edit"></span></button></td>
                <td>
                  <form action="/jabatan/deleteKompetensi/{{$a->id_kompetensi_jabatan}}" method="post">
                    {{csrf_field()}}
                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-block btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <div class="alert alert-warning">
            <i class="fa fa-exclamation-triangle"></i> Tidak ada data.
          </div>
          @endif
        </div>
        <!-- /.card-body -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Modal tambah kompetensi -->
<div class="modal fade" id="tambahKompetensi" tabindex="-1" role="dialog" aria-labelledby="tambahKompetensi" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahKompetensi">Tambah Kompetensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form">
          <div class="card-body">
            <div class="form-group">
              <label for="id_kompetensi_add">Nama Kompetensi</label>
              <select id="id_kompetensi_add" name="id_kompetensi_add" class="form-control select2" style="width: 100%;" required>

              </select>
            </div>
            <div class="form-group">
              <label for="level_kompetensi_add">Level</label>
              <input id="level_kompetensi_add" name="level_kompetensi_add" type="number" class="form-control" id="level_kompetensi" placeholder="Masukkan Level Kompetensi" required>
            </div>
            <div class="form-group">
              <label for="kompetensi_pendahulu_add">Kompetensi Pendahulu</label>
              <select id="kompetensi_pendahulu_add" name="kompetensi_pendahulu_add" class="form-control select2" style="width: 100%;" required>

              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button data-id="{{$id_now}}" id="store" type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal edit kompetensi -->
<div class="modal fade" id="editKompetensi" tabindex="-1" role="dialog" aria-labelledby="editKompetensi" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editKompetensi">Edit Kompetensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form">
          <div class="card-body">
            <div class="form-group">
              <label for="id_kompetensi_edit">ID Kompetensi</label>
              <input type="number" class="form-control" id="id_edit" disabled>
            </div>
            <div class="form-group">
              <label for="id_kompetensi_edit">Nama Kompetensi</label>
              <select id="id_kompetensi_edit" name="id_kompetensi_edit" class="form-control select2" style="width: 100%;">

              </select>
            </div>
            <div class="form-group">
              <label for="level_kompetensi_edit">Level</label>
              <input id="level_kompetensi_edit" name="level_kompetensi_edit" type="number" class="form-control" id="level_kompetensi_edit" placeholder="Masukkan Level Kompetensi">
            </div>
            <div class="form-group">
              <label for="kompetensi_pendahulu_edit">Kompetensi Pendahulu</label>
              <select id="kompetensi_pendahulu_edit" name="kompetensi_pendahulu_edit" class="form-control select2" style="width: 100%;">
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button data-idjab="{{$id_now}}" id="update" type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<!-- DataTables -->
<script src="/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="/AdminLTE/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#tabel-kompetensi-jabatan").DataTable();
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!-- Select2 -->
<script src="/AdminLTE/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
<script>
$(document).ready(function() {
  $(document).on('click', '#tambah', function(e) {
    jQuery.noConflict();
    // $('#lihatjabatan').modal('show');
    $.ajaxSetup({
        headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    })
    e.preventDefault(e);
    $.ajax({
      type: 'get',
      url: '/jabatan/tambahKompetensi',
      dataType: 'json',
      success: function(message) {
        jQuery.noConflict();
        document.getElementById('id_kompetensi_add').innerHTML = '';
        document.getElementById('kompetensi_pendahulu_add').innerHTML = '';
        var optionAppendId = '';
        var optionAppendPendahulu = '<option value=""> - </option>';
        for(var i = 0; i < message.data.length; i++) {
            optionAppendId += '<option value="' + message.data[i]['id_kompetensi'] + '">' + message.data[i]['nama_kompetensi'] + '</option>';
            optionAppendPendahulu += '<option value="' + message.data[i]['id_kompetensi'] + '">' + message.data[i]['nama_kompetensi'] + '</option>';
            console.log(optionAppendPendahulu)
        }
        $('#id_kompetensi_add').append(optionAppendId);
        $('#kompetensi_pendahulu_add').append(optionAppendPendahulu);
        $('#tambahKompetensi').modal('show');
      }
    });
  });

  $(document).on('click','#store',function(e) {
    jQuery.noConflict();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var id = $(this).data('id');
    e.preventDefault(e);
    $.ajax({
      type: 'post',
      url: '/jabatan/storeKompetensi/' + id,
      data: {
        '_token' : $('input[name=_token]').val(),
        'id_jabatan' : id,
        'id_kompetensi' : $('#id_kompetensi_add').val(),
        'level_kompetensi' : $('#level_kompetensi_add').val(),
        'kompetensi_pendahulu' : $('#kompetensi_pendahulu_add').val()
      },
      dataType: 'json',
      success: function(message) {
        // console.log(message)
        if(message.success == true){ // if true (1)
          setTimeout(function(){// wait for 0.7 secs(2)
               location.reload(); // then reload the page.(3)
          }, 700); 
        }
      },
      error: function(message){
        console.log(message)
      }
    });
  });

  $(document).on('click', '#edit', function(e) {
    jQuery.noConflict();
    // $('#lihatjabatan').modal('show');
    $.ajaxSetup({
        headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    })
    e.preventDefault(e);
    var idjab = $(this).data('idjab'); 
    var id = $(this).data('id');
    $.ajax({
      type: 'get',
      url: '/jabatan/editKompetensi/' + idjab + '/' + id,
      dataType: 'json',
      success: function(message) {
        jQuery.noConflict();
        document.getElementById('id_kompetensi_edit').innerHTML = '';
        document.getElementById('kompetensi_pendahulu_edit').innerHTML = '';
        var optionAppendId = '';
        var optionAppendPendahulu = '<option value=""> - </option>';
        for(var i = 0; i < message.data.length; i++) {
            optionAppendId += '<option value="' + message.data[i]['id_kompetensi'] + '">' + message.data[i]['nama_kompetensi'] + '</option>';
            optionAppendPendahulu += '<option value="' + message.data[i]['id_kompetensi'] + '">' + message.data[i]['nama_kompetensi'] + '</option>';
        }
        $("#id_edit").val(id);
        $('#id_kompetensi_edit').append('<option value="' + message.now['id_kompetensi'] + '" selected>' + message.now['nama_kompetensi'] + '</option>');
        $('#level_kompetensi_edit').val(message.now['level_kompetensi']);
        $('#kompetensi_pendahulu_edit').append('<option value="' + message.now['id_kompetensi_pendahulu'] + '" selected>' + message.now['nama_kompetensi_pendahulu'] + '</option>');
        $('#id_kompetensi_edit').append(optionAppendId);
        $('#kompetensi_pendahulu_edit').append(optionAppendPendahulu);
        $('#editKompetensi').modal('show');
      }
    });
  });

  $(document).on('click','#update',function(e) {
    jQuery.noConflict();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var id = $("#id_edit").val()
    var idjab = $(this).data('idjab');
    e.preventDefault(e);
    $.ajax({
      type: 'post',
      url: '/jabatan/updateKompetensi/' + idjab + '/' + id,
      data: {
        '_token' : $('input[name=_token]').val(),
        'id_jabatan' : id,
        'id_kompetensi' : $('#id_kompetensi_edit').val(),
        'level_kompetensi' : $('#level_kompetensi_edit').val(),
        'kompetensi_pendahulu' : $('#kompetensi_pendahulu_edit').val()
      },
      dataType: 'json',
      success: function(message) {
        console.log(message)
        if(message.success == true){ // if true (1)
          setTimeout(function(){// wait for 0.7 secs(2)
               location.reload(); // then reload the page.(3)
          }, 700); 
        }
      },
      error: function(message){
        console.log(message)
      }
    });
  });
});
</script>

@endsection

