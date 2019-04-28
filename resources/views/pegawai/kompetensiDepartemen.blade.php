@extends('master.app')
@section('title') Kompetensi Departemen {{$peg[0]->nama_pegawai}} @endsection
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
           <h1 class="card-title">Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active"><a href="/">Pegawai</a></li>
              <li class="breadcrumb-item active">Kompetensi Departemen</li>
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
          <h3 class="card-title">Kompetensi Departemen {{$peg[0]->nama_pegawai}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        @if($allkompdept->count())
          <table id="table-kompetensi-departemen" class="table">
          <thead>
            <th width="5%">No.</th>
            <th>Status</th>
          </thead>
          <tbody id="KDDetailBody">
            @foreach($allkompdept as $akd)
              <tr>
                <td><h6><b>{{$loop->iteration}}</b></h6></td>
                <td><h5><b>Kompetensi {{$akd->nama_kompetensi}}</b> (level: {{$akd->level_kompetensi}})</h5></td>
              </tr>
              <tr>
                <td></td>
                <td><b>SUDAH</b></td>
              </tr>
              @foreach($done as $d)
                @if($d->nama_kompetensi == $akd->nama_kompetensi && $d->level_kompetensi == $akd->level_kompetensi)
                  <tr>
                    <td></td>
                    <td style="background-color:#c8e6c9">{{$d->nama_training}}</td>
                  </tr>
                @endif
              @endforeach
              <tr>
                <td></td>
                <td><b>BELUM</b></td>
              </tr>
              @foreach($undone as $u)
                @if($u->nama_kompetensi == $akd->nama_kompetensi && $u->level_kompetensi == $akd->level_kompetensi)
                  <tr>
                    <td></td>
                    <td style="background-color:#fff9c4">{{$u->nama_training}}</td>
                  </tr>
                @endif
              @endforeach
            @endforeach
          </tbody>
        </table>
          @else
          <div class="alert alert-warning">
            <i class="fa fa-exclamation-triangle"></i> Departemen tidak memiliki kompetensi.
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
    $('#table-kompetensi-departemen').dataTable({
        "bJQueryUI": true,
        "bStateSave": true,
        "paging":   false,
        "ordering": false,
        "info": false,
        "bFilter": false,
        dom: 'Blfrtip',
        buttons: [
            {
              extend: 'excel',
              text: '<span class="fa fa-file-excel-o"></span> Excel Export',
              exportOptions: {
                  modifier: {
                      search: 'applied',
                      order: 'applied'
                  }
              }
            }
        ]
    });
  });
</script>
@endsection

