@extends('master.app')
@section('title') Direktorat @endsection
@section('css')
<!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE/plugins/datatables/dataTables.bootstrap4.css">
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Direktorat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Direktorat</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List Direktorat
            <div style="float: right;">
              <a href="direktorat/tambah"><button type="button" class="btn btn-block btn-primary">+ Tambah</button></a>
            </div>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        @if($all->count())
          <table id="tabel-direktorat" class="table table-bordered table-striped">
            <thead style="text-align: center">
              <tr>
                <th width="5%">No</th>
                <th>Nama Direktorat</th>
                <th width="20%">Divisi</th>
                <th width="5%"></th>
                <th width="5%"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($all as $a)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$a->nama_direktorat}}</td>
                <td><button id="lihat" type="button" class="btn btn-block btn-secondary btn-sm" data-id="{{$a->id_direktorat}}">lihat</button></td>
                <td><a href="/direktorat/edit/{{$a->id_direktorat}}"><button type="button" class="btn btn-block btn-warning btn-sm"><span class="fa fa-edit"></span></button></a></td>
                <td><form action="/direktorat/delete/{{$a->id_direktorat}}" method="POST">
                            {{csrf_field()}}
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-block btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                    </form></td>
              </tr>
              @endforeach
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

<!-- Modal lihat Divisi -->
<div class="modal fade" id="lihatDivisi" tabindex="-1" role="dialog" aria-labelledby="lihatDivisi" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kompetensiDivisi">List Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <table class="table table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nama Divisi</th>
            </tr>
          </thead>
          <tbody id="DivisiDetailBody">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<!-- DataTables -->
<script src="AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="AdminLTE/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#tabel-direktorat").DataTable();
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $(document).on('click','#lihat',function(e) {
    jQuery.noConflict();
    // $('#lihatDepartemen').modal('show');
    $.ajaxSetup({
        headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    })
    e.preventDefault(e);
    var triggerid = $(this).data('id');
    $.ajax({
      type: 'get',
      url: '/direktorat/show/'+ triggerid,
      dataType: 'json',
      success: function(message) {
        console.log(message)
          jQuery.noConflict();
          document.getElementById('DivisiDetailBody').innerHTML = '';
          var tableAppend = '';
          for(var i = 0; i < message.data.length; i++) {
              tableAppend += '<tr><td>' + (i+1) + '</td><td>' + message.data[i]['nama_divisi'] + '</td></tr>';
          }
          $('#DivisiDetailBody').append(tableAppend);
          $('#lihatDivisi').modal('show');
      },
      error: function(message){
        console.log(message);
      }
    });
  });
});
</script>

@endsection