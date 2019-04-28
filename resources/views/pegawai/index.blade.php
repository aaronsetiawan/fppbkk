@extends('master.app')
@section('title') Data Pegawai @endsection
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="/AdminLTE/plugins/datatables/dataTables.bootstrap4.css">
<!-- Select2 -->
<link rel="stylesheet" href="/AdminLTE/plugins/select2/select2.min.css">
{{-- export --}}
<link rel="stylesheet" href="/css/buttons.dataTables.min.css">

@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Pegawai</li>
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
          <h3 class="card-title">Data Pegawai
            <div style="float: right;">
              <a href="pegawai/tambah"><button type="button" class="btn btn-block btn-primary">+ Tambah</button></a>
            </div>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        @if($all->count())
          <table id="tabel-pegawai" class="table table-bordered table-striped">
            <thead style="text-align: center">
              <tr>
                <th>No</th>
                <th width="10%">NIK</th>
                <th width="35%">Nama</th>
                <th>Departemen</th>
                <th>Jabatan</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th width="12%">Status Kompetensi Departemen</th>
                <th width="12%">Status Kompetensi Jabatan</th>
                <th width="5%"></th>
                <th width="5%"></th>
              </tr>
            </thead>
            <tbody>
            @foreach($all as $a)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$a->nik_pegawai}}</td>
                <td width="20%">{{$a->nama_pegawai}}</td>
                <td width="15%">{{$a->nama_departemen}}</td>
                <td>{{$a->nama_jabatan}}</td>
                <td>{{$a->tanggal_masuk}}</td>
                <td>{{$a->tanggal_keluar}}</td>
                <td><a href="/pegawai/showKD/{{$a->nik_pegawai}}"><button type="button" class="btn btn-block btn-secondary btn-sm">lihat</button></a></td>
                <td><a href="/pegawai/showKJ/{{$a->nik_pegawai}}"><button type="button" class="btn btn-block btn-secondary btn-sm">lihat</button></td>
                <td><a href="/pegawai/edit/{{$a->nik_pegawai}}"><button type="button" class="btn btn-block btn-warning btn-sm"><span class="fa fa-edit"></span></button></a></td>
                <td><form action="/pegawai/delete/{{$a->nik_pegawai}}" method="POST">
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

</div>
@endsection
@section('script')
<!-- DataTables -->
<script src="/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="/AdminLTE/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<!-- Select2 -->
<script src="/AdminLTE/plugins/select2/select2.full.min.js"></script>
{{-- export table --}}
<script src="/js/dataTables.buttons.min.js"></script>
<script src="/js/jszip.min.js"></script>
<script src="/js/buttons.html5.min.js"></script>
<script src="/js/vfs_fonts.js"></script>
<script src="/js/jquery.table2excel.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

<script>
  $(document).ready(function() {
    'use strict';
    $('#tabel-pegawai').dataTable({
        "bJQueryUI": true,
        "bStateSave": true,
        "scrollX": true
    });
  });
</script>
@endsection

