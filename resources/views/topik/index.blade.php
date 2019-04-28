@extends('master.app')
@section('title') Topik @endsection
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
            <h1 class="m-0 text-dark">Topik</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Topik</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List Topik
            <div style="float: right;">
              <a href="topik/tambah"><button type="button" class="btn btn-block btn-primary">+ Tambah</button></a>
            </div>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        @if($all->count())
          <table id="tabel-topik" class="table table-bordered table-striped">
            <thead style="text-align: center">
              <tr>
                <th width="5%">No</th>
                <th>ID</th>
                <th>Topik</th>
                <th width="5%"></th>
                <th width="5%"></th>
              </tr>
            </thead>
            <tbody>
            @foreach($all as $a)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$a->id_topik}}</td>
                <td>{{$a->nama_topik}}</td>
                <td><a href="/topik/edit/{{$a->id_topik}}"><button type="button" class="btn btn-block btn-warning btn-sm"><span class="fa fa-edit"></span></button></a></td>
                <td><form action="/topik/delete/{{$a->id_topik}}" method="POST">
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

@endsection
@section('script')
<!-- jQuery -->
<script src="AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- DataTables -->
<script src="AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="AdminLTE/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#tabel-topik").DataTable();
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

@endsection