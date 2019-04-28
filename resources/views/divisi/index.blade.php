@extends('master.app')
@section('title') Data Divisi @endsection
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
            <h1 class="m-0 text-dark">Divisi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Divisi</li>
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
          <h3 class="card-title">Data Divisi
            <div style="float: right;">
              <a href="divisi/tambah"><button type="button" class="btn btn-block btn-primary">+ Tambah</button></a>
            </div>
          </h3>
        </div>
        @if($all->count())
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <table id="tabel-divisi" class="table table-bordered table-striped">
              <thead style="text-align: center">
                <tr>
                  <th width="5%">No</th>
                  <th>ID</th>
                  <th>Nama Divisi</th>
                  <th>Nama Direktorat</th>
                  <th>List Departemen</th>
                  <th width="5%"></th>
                  <th width="5%"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($all as $a)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$a->id_divisi}}</td>
                  <td>{{$a->nama_divisi}}</td>
                  <td>{{$a->nama_direktorat}}</td>
                  <td><button id="lihat" type="button" class="btn btn-block btn-secondary btn-sm" data-id="{{$a->id_divisi}}">lihat</button></td>
                  <td><a href="divisi/edit/{{$a->id_divisi}}"><button type="button" class="btn btn-block btn-warning btn-sm"><span class="fa fa-edit"></span></button></a></td>
                  <td>
                    <form action="divisi/delete/{{$a->id_divisi}}" method="post">
                      {{csrf_field()}}
                      <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-block btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card-body -->
        @else
        <div class="alert alert-warning">
          <i class="fa fa-exclamation-triangle"></i> Tidak ada data.
        </div>
        @endif
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Modal lihat departemen -->
<div class="modal fade" id="lihatDepartemen" tabindex="-1" role="dialog" aria-labelledby="lihatDepartemen" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kompetensiDepartemen">List Departemen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <table class="table table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nama Departemen</th>
            </tr>
          </thead>
          <tbody id="DepartemenDetailBody">
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
    $("#tabel-divisi").DataTable();
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
      url: '/divisi/show/'+ triggerid,
      dataType: 'json',
      success: function(message) {
        // console.log(message)
          jQuery.noConflict();
          document.getElementById('DepartemenDetailBody').innerHTML = '';
          var tableAppend = '';
          for(var i = 0; i < message.data.length; i++) {
              tableAppend += '<tr><td>' + (i+1) + '</td><td>' + message.data[i]['nama_departemen'] + '</td></tr>';
          }
          $('#DepartemenDetailBody').append(tableAppend);
          $('#lihatDepartemen').modal('show');
      }
    });
  });
});
</script>

@endsection

